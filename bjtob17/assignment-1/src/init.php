<?php
$config = include "config.php";
if ($config["debug"]) {
    ini_set('display_errors',1);
    error_reporting(E_ALL);
}
date_default_timezone_set($config["timezone"]);
include "Services/Autoloader.php";
include "Services/Auth.php";
