<?php
define('BASE_URL','http://www.localhost:8003');
define('PER_PAGE','15');
// database
$conf['database']['driver'] = 'mysql';
$conf['database']['host'] = 'localhost';
$conf['database']['database'] = 'phpskeleton';
$conf['database']['username'] = 'root';
$conf['database']['password'] = '';

// languages settings
$conf['language']['defaultLanguage'] = 'en';
$conf['language']['languages']['en'] = true;
$conf['language']['languages']['es'] = true;

// all modules settings
$conf['module']['defaultModule']= 'frontend';
$conf['module']['frontend']     = [ 'active'            => true,
                                    'requireSession'    => true,
                                    'defaultController' => 'Home',
                                    'defaultAction'     => 'view',
                                    'responseType'      => 'html'
];
$conf['module']['admin']        = [ 'active'            => true,
                                    'requireSession'    => true,
                                    'defaultController' => 'Home',
                                    'defaultAction'     => 'dashboard',
                                    'responseType'      => 'html'
];
$conf['module']['api']          = [ 'active'            => true,
                                    'requireSession'    => false,
                                    'defaultController' => 'Sample',
                                    'defaultAction'     => 'method_missing',
                                    'responseType'      => 'json'

];