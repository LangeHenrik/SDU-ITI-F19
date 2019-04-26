<?php
session_start();

?>
<!DOCTYPE html>
<script type="text/javascript" src="validation.js"></script>
<body>
<style>
body {
	background-color: lightgrey;
}
.reguserForm{
	width:80%;
	height:80%;
	border-style: solid;
	background-color: grey;
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
.submitButton{
	width:100%;
	height:15%;
}
.label{
	position: absolute;
	left:50%;
	top: 0px;
	font-size: 32px;
	transform: translateX(-50%) translateY(-50%);
}
</style>

<div id="yeet"class="reguserForm">
<?php 
if(isset($_SESSION["error"])) {
	$error = $_SESSION['error'];
	echo "<p>$error</p>";
	
}
?>
<p class="label"> Register user </p>
<form action="reguser.php" class="register" onsubmit="return validateRegUser(username.value,password.value,repeatPassword.value,
firstname.value,lastname.value,zip.value,city.value,email.value,phonenumber.value);" method="post">
    <input type="text" class="registerField" name="username" title="Between 5 and 20 characters, no special characters." border="10px" placeholder="username" required>
	<br> 
    <input type="password" class="registerField" title="Between 8 and 20 characters, must contain one uppercase & lowercase letter and one number. No special characters." name="password" placeholder="password" required>
		<br>
    <input type="password" class="registerField" title="use ur brain" name="repeatPassword" placeholder="repeat password" required>
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
    <input type="text" class="registerField" name="phonenumber" title="8 digit phone number" placeholder="phone number" required>
	
    <input type="submit" value="Submit" class="registerField">
</form>
</div>
</body>

</html>
<?php
session_unset();
?>