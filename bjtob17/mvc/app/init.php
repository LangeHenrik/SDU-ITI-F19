<?php
$_SERVER["DOCUMENT_ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/bjtob17/mvc";
include "../framework/init.php";

use app\App;

$config = include "config.php";

if ($config["debug"]) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

$app = new App($config);
$app->start();
