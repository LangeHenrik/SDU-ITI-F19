<?php
session_start();
$path = $_SERVER['PHP_SELF'];
$filename = basename($path, ".php"); 
switch ($filename) {
    case 'signup':
        include("templates/signup_view.php");  // your news template
        require('controllers/signup.php'); // your news functions
    break;
    case 'home':
        include('templates/home_view.php');
        require('controllers/home.php');
    break;
    case 'profile':
        include('templates/profile_view.php');
        require('controllers/profile.php');
    break;
    case 'users':
        include('templates/users_view.php');
        require('controllers/users.php');
    break;
       
    default:
        if ($_GET['filename'] == '') {
            echo ($_GET['filename']);
            include('templates/login_view.php');
        }
        else {
            header('HTTP/1.0 404 Not Found');
        }
    break;
}
