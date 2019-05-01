<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}else if(!empty($_SESSION['email'])){
    session_destroy();
}
header("Location: index.php");
?>
