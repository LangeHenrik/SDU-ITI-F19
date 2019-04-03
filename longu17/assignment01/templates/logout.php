<?php
if(!empty($_SESSION))
{
    session_unset();
    session_destroy();
    $_SESSION['user_id'] == null;
    header("Location:index.php");
} 
