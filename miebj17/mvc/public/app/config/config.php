<?php
    // Database Params
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','mvc');
    define('DB_CHARSET','utf8');

    // App Root
    define('APP_ROOT', dirname(dirname(__FILE__)));
    // URL Root
    $baseUrl = "http://localhost:80";
    define('URL_ROOT', $baseUrl.'/miebj17/mvc/public');
    // Site Name
    define('SITE_NAME', 'miebj17 Assignment2');
    // App Version
    define('APP_VERSION', '1.0.1');
    define('APP_DATE', 'AUG 02, 2018');
    define('APP_DATE_TIME_FORMAT', 'd/m/Y H:i:s');
