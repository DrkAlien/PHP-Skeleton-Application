<?php
namespace App\Middleware;
use Leaf\Http\Session;

/**
* This is a before middleware
*/
class IsAdminLoggedIn
{
    public function handle($controller, \Closure $next) {
        if($controller->request->controller != 'Home' || (in_array($controller->request->controller,['Home']) && !in_array($controller->request->action,['login','logout']))) {
            $admin = Session::get('admin');
            if(empty($admin)) {
                $controller->request::redirect(SITE_URL.'/'.$controller->request->module.'/login');
            }
        }
        // do your code above this line
        return $next($controller);
    }
}