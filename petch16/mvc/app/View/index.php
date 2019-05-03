<?php
// Initialize the session
if (session_status() == PHP_SESSION_NONE ) {
	session_start();
}

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: /petch16/login");
    exit;
}else{
    header("Location: /petch16/welcome");
    exit;
}