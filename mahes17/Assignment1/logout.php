<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!empty($_SESSION['user'])){
    session_destroy();
}
//redirect the user to the home page
header("Location: index.php");
?>