<?php
namespace App\Middleware;

/**
* This is a BLANK after middleware example
* It will be executed right after the call of the Controller@action
*/
class AfterMiddleware
{
    public function handle($controller, \Closure $next) {
        $response = $next($controller);
        // do your code bellow this line

        return $response;
    }
}