<?php 
	session_start();
	unset($_SESSION['loggedin']);
	
	echo 'You have cleaned session';
	header('Location: login_page.php')
?>
