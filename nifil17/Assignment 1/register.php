<!DOCTYPE html>
<script type="text/javascript" src="validation.js"></script>
<body>
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

.registerForm{
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

.register{
	width:80%;
	height:80%;
	position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
}

.registerField{
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
<div class="registerForm">
<p class="label"> Register user </p>
<form action="saveuser.php" class="register" onsubmit="return validateRegUser(username.value, password.value, repeatPassword.value,
firstname.value, lastname.value, zip.value, city.value, email.value, number.value);" method="post">
	<input type="text" class="registerField" name="username" title="Between 5 and 16 characters, no special characters." border="10px" placeholder="username" required>
	<br>
    <input type="password" class="registerField" name='password' title="Between 8 and 20 characters, must contain one uppercase & lowercase letter and one number. No special characters." placeholder="password" required>
	<br>
    <input type="password" class="registerField" name="repeatPassword" title='repeat the password' placeholder="repeat password" required>
	<br>
    <input type="text" class="registerField" name="firstname" title="Between 1 and 30 characters, no weird letters." placeholder="first name" required>
	<br>
    <input type="text" class="registerField" name="lastname" title="Between 1 and 30 characters, no weird letters." placeholder="last name" required>
	<br>
    <input type="text" class="registerField" name="zip" title="Four digit zip code" placeholder="zip code" required>
	<br>
    <input type="text" class="registerField" name="city" title="Between 1 and 30 characters" placeholder="city" required>
	<br>
    <input type="text" class="registerField" name="email" title="Email" placeholder="email" required>
	<br>
    <input type="text" class="registerField" name="number" title="8 digit phone number" placeholder="phone number" required>
	<br>
    <input type="submit" value="Submit" class="submit">
</form>
	<a href = "index.php"> Login </a>
</body>
</html>

<?php
session_unset();
?>

