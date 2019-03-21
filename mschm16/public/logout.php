<?php include 'includes/top.php';

// remove all session variables
session_unset();

// destroy the session
session_destroy(); 

header("Location: login.php");
exit;

include 'includes/bot.php';
?>