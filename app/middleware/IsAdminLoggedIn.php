<?php
namespace App\Middleware;

/**
* This is a before middleware
*/
class IsAdminLoggedIn
{
    public function handle($controller, \Closure $next) {
        if($controller->request->controller != 'Home' || (in_array($controller->request->controller,['Home']) && !in_array($controller->request->action,['login','logout']))) {
            if(!$controller->session->exist('admin')) {
                $controller->request::redirect(SITE_URL.'/'.$controller->request->module.'/login');
            }
        }
        // do your code above this line
        return $next($controller);
    }
}