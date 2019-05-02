<?php

include '../app/views/partials/menu.php';

if (session_status() == PHP_SESSION_NONE) {
	header("localhost:8080/nifil17/mvc/public/home");
}

?>

<!DOCTYPE html>
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

.form{
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

.form2{
	width:80%;
	height:80%;
	position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
}

.field{
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
<div class="form">
<p class="label"> Home </p>
<form method="post" name="form" class="form2" action="home/logout">
    <input type="button" class='submit' value="Create user" onclick="javascript:window.location.href='user/create'">
	<br>
    <input type="button" class='submit' value="Users" onclick="javascript:window.location.href='user'">
	<br>
    <input type="button" class='submit' value="Upload picture" onclick="javascript:window.location.href='picture/upload'">
	<br>
    <input type="button" class='submit' value="Pictures" onclick="javascript:window.location.href='picture'">
	<br>
	<input type="button" class='submit' value="Login" onclick="javascript:window.location.href='home/login'">
	<br>
    <input type="submit" class='submit' value="Logout">
</form>
</body>
</html>
