<?php

include '../app/views/partials/menu.php';

if (session_status() == PHP_SESSION_NONE ) {
	session_start();
}

?>

<!DOCTYPE html>

<script type="text/javascript" src="nifil17/mvc/app/services/validation.js"></script>

<style>

body {
	background-color: green;
}

.label{
	position: absolute;
	left:50%;
	top: 0px;
	font-size: 32px;
	transform: translateX(-50%) translateY(-50%);
}

.loginForm{
	width: 80%;
	height: 80%;
	border-style: solid;
	background-color: white;
	padding: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);	
}

.login{
	width:80%;
	height:80%;
	position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
}

.loginField{
	width:100%;
	height:10%;
	margin-bottom: 3px;
	font-size: 32px;
}

.submit{
	width:100%;
	height:10%;
	margin-bottom: 3px;
	font-size: 32px;
}

</style>

<body>
<div class="loginForm">
<p class="label"> Login </p>
<form action="loginAuth" method="post" name="loginForm" class="login" onsubmit="return validateForm(username.value, password.value);">
    <input type="text" class='loginField' name="username" placeholder="Enter your username" required>
	<br>
    <input type="password" class='loginField' name="password" placeholder="Enter your password" required>
	<br>
    <input type="submit" class='submit' value="Submit">
</form>
	<a href = "../user/create"> Register user </a>
</body>
</html>

<?php 
if(isset($_SESSION["error"])) {
	$error = $_SESSION['error'];
	echo "<span>$error</span>";
}
?>

<?php
unset($_SESSION["error"]);
?>
