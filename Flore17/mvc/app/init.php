<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

require_once 'core/Router.php';
require_once 'core/Database.php';
require_once 'core/Controller.php';
