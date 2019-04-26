<?php
//user logout
session_start();

$_SESSION['username'] = "";
$_SESSION['password'] = "";
$_SESSION['isLogged'] = false;

header('Location: index.php');
?>