<?php
namespace App\Middleware;

/**
* This is a before middleware
*/
class ValidateAction
{
    public function handle($controller, \Closure $next) {
        $method = str_replace('-', '_', $controller->request->action);
        if(!method_exists($controller, $method)) {
            /**
            * Change something in the controller
            * You can use get_class_methods() and use the first method as default
              or you can redirect to the default controller & action of the module
            */
            $module = ($controller->request->module == \App\App::$conf->module->defaultModule)? '' : '/'.$controller->request->module;
            $controllerMethods = get_class_methods($controller);
            if(!empty($controllerMethods)) {
                $controller->request->action = $controllerMethods[0];
            } else {
                $controller->request::redirect(SITE_URL.$module.'/'.\App\App::$conf->module->{$module}->defaultAction.'/');
            }


            #$controller->response->... = 'middleware before: "validate action"';
            /**
            * Throw a hard exception
            */
            #throw new \Exception('Invalid action.');

            /**
            * Do a redirect to /
            */
            #$controller->redirect(SITE_URL);exit;
        }
        // do your code above this line
        return $next($controller);
    }
}