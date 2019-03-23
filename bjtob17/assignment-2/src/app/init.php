<?php
include "../framework/init.php";
include "App.php";

$config = include "config.php";

if ($config["debug"]) {
    ini_set('display_errors',1);
    error_reporting(E_ALL);
}

$app = new \app\App($config);
$app->start();
