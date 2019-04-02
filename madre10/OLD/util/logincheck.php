<?php
session_start();
//Check if user is logged in..
if(!isset($_SESSION['user_id'])){
    header("Location: /login.php");
}