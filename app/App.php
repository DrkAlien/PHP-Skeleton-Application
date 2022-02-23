<?php
namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Ghostff\Session\Session;

use \stdClass;

class Request {
    
    public $language = 'en';
    public $module;
    public $controller;
    public $action;
    public $payload;
    public $session;
    public function __construct() {}
    public static function redirect($to) {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Location: '.$to);exit;
    }
}

class Response {

    public $module;
    public $controller;
    public $action;
    public $type;
    public $code = '200';
    public $headers = [];
    public $htmlPath;
    public $requestParams = []; // the params from the \Request
    private $data;
    private $body;

    public function __construct() {}

    public function getControllerUrl() {
        $module = ($this->module != App::$conf->module->defaultModule)? $this->module.'/':'';
        return SITE_URL.'/'.$module.$this->controller;
    }

    public function getActionUrl() {
        $module = ($this->module != App::$conf->module->defaultModule)? $this->module.'/':'';
        return $this->getControllerUrl().'/'.$this->action;
    }

    public function setData($data, $key = '') {
        if(!empty($key) && is_string($key)) {
            $this->data[$key] = $data;
        } else {
            $this->data = $data;
        }
    }

    public function getData($key = '') {
        if(!empty($key) && is_string($key)) {
            return (isset($this->data[$key]))? $this->data[$key]:'';
        }
        return $this->data;
    }

    public function setView($path) {
        $this->htmlPath = $path;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function loadHtml($path) {
        $html = '';
        if(file_exists($path)) {
            ob_start();
            require_once($path);
            $html = ob_get_contents();
            ob_end_clean();
        } else {
            throw new \Exception("\App\Response: View file not found.");
        }
        return $html;
    }

    public function prepare() {
        $this->type = (empty($this->type))? App::$conf->module->{$this->module}->responseType:$this->type;
        switch($this->type) {
            default:
            case 'html':
                $this->headers[] = 'Content-Type: text/html; charset=utf-8';
                $this->htmlPath = (empty($this->htmlPath))? APPLICATION_PATH.'/app/modules/'.$this->module.'/view/index.php':$this->htmlPath;
                $this->setBody($this->loadHtml($this->htmlPath));
            break;
            case 'json':
                $this->headers[] = 'Content-Type: application/json; charset=utf-8';
                if(is_array($this->data)) {
                    $this->setBody(json_encode($this->data));
                } else if(is_string($this->data)) {
                    $this->setBody($this->data);
                } else {
                    throw new \Exception("\App\Response: Unexpected JSON data type.");
                }
            break;
            case 'csv':
                throw new \Exception("\App\Response: Please format the CSV.");
            break;
            case 'pdf':
                $this->headers[] = 'Content-Type: application/pdf';
                throw new \Exception("\App\Response: Please format the PDF.");
            break;
        }
        return $this;
    }

    // body is sent directly to the end user
    public function setBody($body) {
        $this->body = $body;
    }
    public function getBody() {
        return $this->body;
    }

    public function send() {
        http_response_code(intval($this->code));
        foreach($this->headers as $header) {
            header($header);
        }
        echo $this->getBody();
    }
}

class App {

    public static $conf;
    public static $session;
    public $request;
    public $response;
    private $middlewareStack;

    public function __construct( $conf = array() ) {
        self::$conf = json_decode(json_encode($conf));
        $this->loadVendor();
        $this->getRoute();
        $this->loadEloquent();
        if(self::$conf->module->{$this->request->module}->requireSession) {
            // https://github.com/Ghostff/Session
            self::$session = new Session();
            $this->request->session = self::$session;
        }
    }

    private function loadVendor() {
        require_once(APPLICATION_PATH.'/vendor/autoload.php');
    }

    private function loadEloquent() {
        $capsule = new Capsule;
        $dbconf = json_decode(json_encode(self::$conf->database),true);
        $capsule->addConnection($dbconf);
        $capsule->bootEloquent();
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
        $this->request = new Request();
        $this->request->method = (in_array($_SERVER['REQUEST_METHOD'],['GET','POST','PUT','DELETE']))? strtoupper($_SERVER['REQUEST_METHOD']):'';
        // payload is from $_POST and $_GET, if you need PUT data, you will have to get it with a middleware or something
        if($this->request->method == 'POST' && isset($_POST) && !empty($_POST)) {
            $this->request->payload = $_POST;
        }
        if($this->request->method == 'GET' && isset($_GET) && !empty($_GET)) {
            $this->request->payload = $_GET;
        }

        $url = trim(substr($_SERVER['REQUEST_URI'], strlen(dirname($_SERVER['PHP_SELF'] ))),'/');
        $url = strtok($url, '?');
        $url = explode('/', $url);

        // the language comes first after SITE_URL/en/
        $current = key($url);
        if(!empty($url[$current]) && isset(self::$conf->language->languages->{$url[$current]}) && self::$conf->language->languages->{$url[$current]} === true) {
            $this->request->language = $url[$current];
            next($url);
            define('SITE_URL',BASE_URL.'/'.$this->request->language);
        } else {
            $this->request->language = self::$conf->language->defaultLanguage;
            define('SITE_URL',BASE_URL);
        }

        // the module comes 2nd. If not found, default is used. Then skip. SITE_URL/en/module ( /admin, /user )
        $current = key($url);
        if(!empty($url[$current]) && isset(self::$conf->module->{$url[$current]}) && self::$conf->module->{$url[$current]}->active == true) {
            $this->request->module = $url[$current];
            next($url);
        } else {
            $this->request->module = self::$conf->module->defaultModule;
        }

        $current = key($url);
        // the controller comes 3rd. If not found, default is used. Then skip. SITE_URL/en/module/controller
        if(isset($url[$current]) && !empty($url[$current])) {
            $controllerPath = APPLICATION_PATH.'/app/modules/'.$this->request->module.'/controller/'.ucfirst($url[$current]).'Controller.php';
            if(file_exists($controllerPath)) {
                $this->request->controller = $url[$current];
                next($url);
            } else {
                $this->request->controller = self::$conf->module->{$this->request->module}->defaultController;
            }
        } else {
            $this->request->controller = self::$conf->module->{$this->request->module}->defaultController;
        }
        // the action/method is mostly there on any position (before params) unless you want the default controller and action. SITE_URL/action
        $current = key($url);
        $this->request->action = (!empty($url[$current]))? $url[$current] : self::$conf->module->{$this->request->module}->defaultAction;
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
                        $this->request->$param = $value;
                    } else {
                        $this->request->uuid = $param;
                    }
                }
            }
        }
    }

    /*
    * A simple stak a list of middlewares.
    * Called from public/index.php. The path does not cointain any \ at the begining and end
    * The middleware will be called for the entire module or just one controller in one module
    * $path: e.g. just "Module" or "Module\Controller" on which the middleware is called
    *
    */
    public function addMiddleware(string $middleware, string $path = 'Any') {
        if(class_exists($middleware)) {
            $this->middlewareStack[$path][] = new $middleware();
        } else {
            throw new \Exception("\App: Middleware class not found.");
        }
    }

    /*
    * Select middlewares that are to be executed
    * 'peel' the entire 'onion' of middlewares before and after the controller action is called
    *
    */
    private function middleware($controller, \Closure $action) {
        $any = (isset($this->middlewareStack['Any']))? $this->middlewareStack['Any']:[];
        $moduleMiddleware = (isset($this->middlewareStack[ucfirst($this->request->module)]))? $this->middlewareStack[ucfirst($this->request->module)]:[];
        $controllerMiddleware = (isset($this->middlewareStack[ucfirst($this->request->module).'\\'.ucfirst($this->request->controller)]))? $this->middlewareStack[ucfirst($this->request->module).'\\'.ucfirst($this->request->controller)]:[];
        // build up the middleware list by the $path and keep the order by which they were added
        $middlewares = array_reverse(array_merge($any, $moduleMiddleware, $controllerMiddleware));
        $onion = array_reduce($middlewares, function($nextLayer, $layer) {
            return function($controller) use($nextLayer, $layer) {
                        return $layer->handle($controller, $nextLayer);
            };
        }, $action);
        return $onion($controller);
    }

    // instantiate the controller and run it with the middlewares
    public function run() {
        // only one controller is included
        require_once(APPLICATION_PATH. '/app/modules/'.$this->request->module.'/controller/'.ucfirst($this->request->controller).'Controller.php');
        $controller = '\App\\'.ucfirst($this->request->module).'\\Controller\\'.ucfirst($this->request->controller);
        $controller = new $controller();
        // assign the Request and the Response to the controller
        $controller->request = $this->request;
        $controller->response = new Response();
        // run the controller and the middlewares
        $controller = $this->middleware($controller, function($controller) {
            /*
            * $controller->request->action - the controller's called method
            * the ValidAction middleware verifies that this method is valid
            */
            $controller->{str_replace('-', '_', $controller->request->action)}();
            return $controller;
        });
        // prepare the response
        $controller->response->prepare()->send();
    }
}
