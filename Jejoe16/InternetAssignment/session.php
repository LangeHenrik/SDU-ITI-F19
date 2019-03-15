<?php
include('database.php');
session_start();

$user_check = $_SESSION['login_user'];

$login_session = getUsername($user_check);

if(!isset($_SESSION['login_user'])){
    header("location:login.php");
    die();
}
?>