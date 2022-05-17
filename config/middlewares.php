<?php
// executed in every module, for all controllers
$app->addMiddleware('\App\Middleware\PrepareResponse');
$app->addMiddleware('\App\Middleware\ValidateAction');
// executed in the Admin module for all controllers
$app->addMiddleware('\App\Middleware\IsAdminLoggedIn', 'Admin');