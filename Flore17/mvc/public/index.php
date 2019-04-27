<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

if (session_status() == PHP_SESSION_NONE ) {
	session_start();
}

$_SESSION['count'] = 20;
	
require_once '../app/init.php';

$router = new Router();
