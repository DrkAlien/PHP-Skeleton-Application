<?php
/**
* PHP Skeleton Application
* Developer : Halmagean Daniel
* Twitter   : https://twitter.com/HalmageanD
*
*/
define('APPLICATION_PATH', Realpath(dirname(__DIR__, 1)));
require_once(APPLICATION_PATH.'/config.php');
require_once(APPLICATION_PATH.'/app/Request.php');
require_once(APPLICATION_PATH.'/app/Response.php');
require_once(APPLICATION_PATH.'/app/App.php');
$app = new \App\App($conf);
// executed in every module, for all controllers
$app->addMiddleware('\App\Middleware\PrepareResponse');
$app->addMiddleware('\App\Middleware\ValidateAction');
// executed in the Admin module for all controllers
$app->addMiddleware('\App\Middleware\IsAdminLoggedIn', 'Admin');
$app->run();




