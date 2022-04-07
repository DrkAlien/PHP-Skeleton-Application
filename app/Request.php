<?php
namespace App;

class Request {

    public $language = 'en';
    public $module;
    public $controller;
    public $action;
    public $payload;

    private $headers;
    private $conf;

    public function __construct($conf) {
        $this->conf = $conf;
        $this->getRoute();
        unset($this->conf);
        $this->headers = getallheaders();
    }

    public static function redirect($to) {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Location: '.$to);exit;
    }

    public function headers() {
        return $this->headers;
    }

    public function hasHeader($key = '') {
        if(isset($this->headers[$key])) {
            return true;
        }
        return false;
    }

    public function getHeader($key = '') {
        if(empty($this->headers)) {
            $this->headers();
        }
        if(isset($this->headers[$key])) {
            return $this->headers[$key];
        }
        return '';
    }

    public function get($var = '') {
        if(isset($this->{$var})) {
            return $this->{$var};
        }
        if(isset($this->payload[$var])) {
            return $this->payload[$var];
        }
        return '';
    }

    public function has($var = '') {
        if(isset($this->{$var})) {
            return true;
        }
        if(isset($this->payload[$var])) {
            return true;
        }
        return false;
    }

    /*
    *   Create Route variables and request data
    *   The URL structure mush follow this rule
    *   SITE_URL/language/module/controller/action/var1/value/var2/value/...etc
    *   If any of the language, module...etc is missing/doesn't exists, default (from config.php) is used
    *   The action follows this rule: URL /this-is-the-action = Controller->this_is_the_action()
    *   The "uuid" (= var1) parameter appears when the action is there and the var1 has no value e.g. .../view/var1
    *   SITE_URL is defined here
    */
    private function getRoute() {
        $this->method = (in_array($_SERVER['REQUEST_METHOD'],['GET','POST','PUT','DELETE']))? strtoupper($_SERVER['REQUEST_METHOD']):'';
        // payload is from $_POST and $_GET, if you need PUT data, you will have to get it with a middleware or something
        if($this->method == 'POST' && isset($_POST) && !empty($_POST)) {
            $this->payload = $_POST;
        }
        if($this->method == 'GET' && isset($_GET) && !empty($_GET)) {
            $this->payload = $_GET;
        }

        $url = trim(substr($_SERVER['REQUEST_URI'], strlen(dirname($_SERVER['PHP_SELF'] ))),'/');
        $url = strtok($url, '?');
        $url = explode('/', $url);

        // the language comes first after SITE_URL/en/
        $current = key($url);
        if(!empty($url[$current]) && isset($this->conf->language->languages->{$url[$current]}) && $this->conf->language->languages->{$url[$current]} === true) {
            $this->language = $url[$current];
            next($url);
            define('SITE_URL',BASE_URL.'/'.$this->language);
        } else {
            $this->language = $this->conf->language->defaultLanguage;
            define('SITE_URL',BASE_URL);
        }

        // the module comes 2nd. If not found, default is used. Then skip. SITE_URL/en/module ( /admin, /user )
        $current = key($url);
        if(!empty($url[$current]) && isset($this->conf->module->{$url[$current]}) && $this->conf->module->{$url[$current]}->active == true) {
            $this->module = $url[$current];
            next($url);
        } else {
            $this->module = $this->conf->module->defaultModule;
        }

        $current = key($url);
        // the controller comes 3rd. If not found, default is used. Then skip. SITE_URL/en/module/controller
        if(isset($url[$current]) && !empty($url[$current])) {
            $controllerPath = APPLICATION_PATH.'/app/modules/'.$this->module.'/controller/'.ucfirst($url[$current]).'Controller.php';
            if(file_exists($controllerPath)) {
                $this->controller = $url[$current];
                next($url);
            } else {
                $this->controller = $this->conf->module->{$this->module}->defaultController;
            }
        } else {
            $this->controller = $this->conf->module->{$this->module}->defaultController;
        }
        // the action/method is mostly there on any position (before params) unless you want the default controller and action. SITE_URL/action
        $current = key($url);
        $this->action = (!empty($url[$current]))? $url[$current] : $this->conf->module->{$this->module}->defaultAction;
        next($url);

        // fetching the remaining parameteres
        $current = key($url);
        if(is_numeric($current) && $current > 0) {
            $params = array_slice($url, $current);
            for($i = 0; $i < count($params); $i+=2) {
                if(isset($params[$i])) {
                    // the parameter's name can contain letters, numbers, dot, underscore, comma and the plus sign
                    $param = preg_replace('/[^0-9a-zA-Z\-\.\_\,\+]/', '', $params[$i]);
                    $value = (isset($params[$i+1]))? $params[$i+1]:'';
                    if(!empty($param) && strlen($value) > 0) {
                        $this->$param = $value;
                    } else {
                        $this->uuid = $param;
                    }
                }
            }
        }
    }


}