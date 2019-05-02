<?php
// Initialize the session
if (session_status() == PHP_SESSION_NONE ) {
	session_start();
}
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("Location: login");
exit;
?>