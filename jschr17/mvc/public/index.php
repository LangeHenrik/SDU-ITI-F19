<?php

if (session_status() == PHP_SESSION_NONE ) {
	session_start();
}

require_once '../app/init.php';

$router = new Router();

//these two completely break the site: SyntaxError: JSON.parse: unexpected character at line 1 column 1 of the JSON data
//include_once(__DIR__ . '/api/users/read.php');
//include_once(__DIR__ . '/api/pictures/user/getimg.php');

$router->add('/');
$router->add('/api/users', read());
$router->add('/api/pictures/user', readimg());

//echo '<pre>'; echo print_r($router); echo '</pre>';

$router->submit();