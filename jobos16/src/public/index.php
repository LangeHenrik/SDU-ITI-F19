<?php

/**
 * Register class auto loader
 */
spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    require_once __DIR__ . "/../{$class}.php";
});

// Create instance of the application
$app = require_once __DIR__ . '/../app/init.php';
$app->init();

// Run application
echo $app->run();

?>