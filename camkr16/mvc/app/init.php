<?php
spl_autoload_register(function ($class_name) {
    $filename = str_replace("\\", "/", $class_name);
    require_once $filename . '.php';
});

use core\Router;

$router = new Router();
