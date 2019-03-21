<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	echo "Logged in.";
}
?>
<style>
	body {font-family: "Montserrat", sans-serif}
</style>

<body>
	<nav>
	<a href="login.php">Login</a>
	<a href="logout.php">Logout</a>
	<a href="register.php">Register</a>
	<a href="pictures.php">Pictures</a>
	<a href="uploadpictures.php">Upload Pictures</a>
	<a href="users.php">Users</a>
	<nav/>
	<hr>
</body>