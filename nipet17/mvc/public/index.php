<?php

if (session_status() == PHP_SESSION_NONE ) {
	session_start();
}

require_once '../app/init.php';
$_SESSION['count'] = 0;
$_SESSION['imgMsg'] = "";

$router = new Router();
