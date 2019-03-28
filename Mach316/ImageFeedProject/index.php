<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-28
 * Time: 12:36
 */
$request = $_SERVER['REDIRECT_URL'];

switch ($request) {
    case '/' :
        require __DIR__ . '/PHP/Views/index.php';
        break;
    case '' :
        require __DIR__ . '/PHP/Views/index.php';
        break;
    case '/about' :
        require __DIR__ . '/PHP/Views/about.php';
        break;
    default:
        require __DIR__ . '/PHP/Views/404.php';
        break;
}