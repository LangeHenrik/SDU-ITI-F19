<?php
session_start();

if(isset($_SESSION['username'])) {
    session_destroy();
}
header("Location:http://localhost:8000/PHP/LoginPage.php")
?>