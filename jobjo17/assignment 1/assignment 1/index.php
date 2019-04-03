<?php
session_start();
if(isset($_SESSION['user_id'])) {
	header("Location: home.php");
}
?>
<!DOCTYPE html>
<style>
.yeet {
	width: 50%;
	min-width: 100px;
	max-width: 200px;
}
</style>
<script type="text/javascript" src="validation.js"></script>

<body>

<form action="loginauth.php" onsubmit="return validateForm(username.value, password.value);" name="loginform" class="yeet" method="post">
    <input type="text" name="username" placeholder="Enter your username" required>
    <input type="password" name="password" placeholder="Enter your password" required>
    <input type="submit" value="Submit">
</form>
<?php 
if(isset($_SESSION["error"])) {
	$error = $_SESSION['error'];
	echo "<span>$error</span>";
}
?>
<form action="registerUsers.php">
	<input type="submit" value="Register users">	
</form>

</body>
</html>
<?php
	unset($_SESSION["error"]);
	?>