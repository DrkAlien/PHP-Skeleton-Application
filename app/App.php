<?php
namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Leaf\Http\Session;
use \stdClass;

class App {

    private $middlewareStack;
    public $request;
    public $response;
    public static $conf;

    public function __construct($conf) {
        self::$conf = json_decode(json_encode($conf));
        $this->loadVendor();
        $this->loadEloquent();
        $this->request = new Request(self::$conf);
        if(self::$conf->module->{$this->request->module}->requireSession) {
            new Session;
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
