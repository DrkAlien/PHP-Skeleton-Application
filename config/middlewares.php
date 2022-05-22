<?php
// executed in every module, for all controllers
$app->addMiddleware('\App\Middleware\PrepareResponse');
$app->addMiddleware('\App\Middleware\ValidateAction');
$app->addMiddleware('\App\Middleware\SetLanguageLocale','Frontend');
// executed in the Admin module for all controllers
$app->addMiddleware('\App\Middleware\IsAdminLoggedIn', 'Admin');