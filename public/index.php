<?php
/**
* PHP Skeleton Application
* Developer : Halmagean Daniel
* Twitter   : https://twitter.com/HalmageanD
*
*/
define('APPLICATION_PATH', Realpath(dirname(__DIR__, 1)));
require_once(APPLICATION_PATH.'/config/config.php');
require_once(APPLICATION_PATH.'/app/Request.php');
require_once(APPLICATION_PATH.'/app/Response.php');
require_once(APPLICATION_PATH.'/app/App.php');
$app = new \App\App($conf);
require_once(APPLICATION_PATH.'/config/middlewares.php');
$app->run();




