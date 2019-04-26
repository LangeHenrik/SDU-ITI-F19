
<?php 
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

If(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
	$_SESSION["logged_in"] = false;
    header("Location:Index.php");	
} else {
    header("Location:Index.php");
}





