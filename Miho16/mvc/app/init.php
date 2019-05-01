<?php
//require_once 'core/Router.php';
//require_once 'core/db_manager.php';
//require_once 'core/Controller.php';
//$router = new Router();
spl_autoload_register(function ($class_name) {
    $filename = str_replace("\\", "/", $class_name);
    require_once $filename . '.php';
});
use core\Router;
$router = new Router();
