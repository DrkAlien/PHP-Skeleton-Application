<?php
namespace App\Middleware;

/**
* This is a BLANK before middleware example
* It will be executed right BEFORE the Controller@action gets called
*/
class BeforeMiddleware
{
    public function handle($controller, \Closure $next) {

        // do your code above this line
        return $next($controller);
    }
}