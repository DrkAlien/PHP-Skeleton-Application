<?php
namespace App\Middleware;

class SetLanguageLocale
{
    public function handle($controller, \Closure $next) {
        putenv('LANG='.$controller->request->language);
        putenv('LANGUAGE='.$controller->request->language);
        setlocale(LC_ALL, $controller->request->language);
        $domain = 'default';
        textdomain($domain);
        bindtextdomain($domain, APPLICATION_PATH.'/locales');
        bind_textdomain_codeset($domain, 'UTF-8');
        // do your code above this line
        return $next($controller);
    }
}