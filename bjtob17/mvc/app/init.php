<?php
$_SERVER["DOCUMENT_ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/bjtob17/mvc";
include "../framework/init.php";

use app\App;

$configArray = include "config.php";
$_SERVER["route_offset"] = $configArray["route_offset"];

if ($configArray["debug"]) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

$app = new App();
$app->start();
