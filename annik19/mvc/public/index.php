<?php

if (session_status() == PHP_SESSION_NONE ) {
	session_start();
}

require_once '../app/init.php';

//echo 'new Router';
$router = new Router();