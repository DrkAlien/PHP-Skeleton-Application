<?php
namespace App\Middleware;

/**
* This is an after middleware, gets called AFTER the controller
* This is a mandatory middleware since we did not want to add this code
  in the \App class, thus allowing you to make some changes without changing the core
*/
class PrepareResponse
{
    public function handle($controller, \Closure $next) {
        $response = $next($controller);

        // do your code bellow this line, change the $controller
        /*
            In order to have access to some data from the App\Request,
            we need to populate the App\Response.

            This middleware prepares the App\Response for the view part,
            where the Controller and App\Request is not accessible anymore
        */
        $controller->response->language = $controller->request->language;
        $controller->response->module = $controller->request->module;
        $controller->response->controller = $controller->request->controller;
        $controller->response->action = $controller->request->action;
        $ignoreKeys = ['language','module','controller','action','payload','session','method'];
        /*
            ->requestParams are the params from the URL /a/val_1/b/val_2/...
        */
        foreach($controller->request as $k => $v) {
            if(!in_array($k, $ignoreKeys) && is_string($v)) {
                $controller->response->requestParams[$k] = $k.'/'.$v;
            }
        }
        return $response;
    }
}