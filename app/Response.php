<?php
namespace App;

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

    public function getControllerUrl() :string {
        $module = ($this->module != App::$conf->module->defaultModule)? $this->module.'/':'';
        return SITE_URL.'/'.$module.$this->controller;
    }

    public function getActionUrl() :string {
        $module = ($this->module != App::$conf->module->defaultModule)? $this->module.'/':'';
        return $this->getControllerUrl().'/'.$this->action;
    }

    public function setHeader(string $header = '') :void {
        $this->headers[] = $header;
    }

    public function setData($data, string $key = '') {
        if(!empty($key) && is_string($key)) {
            $this->data[$key] = $data;
        } else {
            $this->data = $data;
        }
    }

    public function getData(string $key = '') {
        if(!empty($key) && is_string($key)) {
            return (isset($this->data[$key]))? $this->data[$key]:'';
        }
        return $this->data;
    }

    public function setView(string $path) :void {
        $this->htmlPath = $path;
    }

    public function setType(string $type) :void {
        $this->type = $type;
    }

    public function setCode(int $code) :void {
        $this->code = $code;
    }

    public function loadHtml(string $path) {
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

    public function prepare() :self {
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