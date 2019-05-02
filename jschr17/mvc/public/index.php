<?php

if (session_status() == PHP_SESSION_NONE ) {
	session_start();
}

require_once '../app/init.php';

$router = new Router();

//these two completely break the site: SyntaxError: JSON.parse: unexpected character at line 1 column 1 of the JSON data
//include_once 'api/users/read.php';
//include_once 'api/pictures/users/getimg.php';

$router->add('/', ' ');
$router->add('/api/users', read());
$router->add('/api/pictures/user', read());

echo '<pre>'; echo print_r($router); echo '</pre>';

$router->submit();