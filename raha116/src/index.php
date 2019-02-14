<?php

use framework\Framework;

// Setup a very simple auto loading, so we can use classes without having to
// include the source files all the time manually.
spl_autoload_register(function ($class_name) {
    $filename = str_replace("\\", "/", $class_name);
    require_once $filename . '.php';
});

$framework = new Framework();
$framework->handle();

