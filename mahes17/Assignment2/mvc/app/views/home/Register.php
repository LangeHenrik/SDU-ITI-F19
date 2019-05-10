<div class="register">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="registerForm" method="post">
	<h1>Register</h1>

	<input name="username" placeholder="Username" type="text" id="registerFields">
		<span class="error"><?php echo $username_error?></span><br>

	<input name="password" placeholder="Password" type="password" id="registerFields">
		<span class="error"><?php echo $password_error?></span><br>

	<input name="passwordRepeat" placeholder="Repeat password" type="password" id="registerFields">
		<span class="error"><?php echo $passwordRepeat_error?></span><br>

	<input name="firstName" placeholder="First name" type="text" id="registerFields">
		<span class="error"><?php echo $firstName_error?></span><br>

	<input name="lastName" placeholder="Last name" type="text" id="registerFields">
		<span class="error"><?php echo $lastName_error?></span><br>

	<input name="zipcode" placeholder="zipcode" type="text" id="registerFields">
		<span class="error"><?php echo $zipcode_error?></span><br>

	<input name="city" placeholder="City" type="text" id="registerFields">
		<span class="error"><?php echo $city_error?></span><br>

	<input name="email" placeholder="Email" type="text" id="registerFields">
		<span class="error"><?php echo $email_error?></span><br>

	<input name="phoneNumber" placeholder="Phone" type="text" id="registerFields">
		<span class="error"><?php echo $phoneNumber_error?></span><br>

	<div id="registerBtn">
		<input class="button" id="registerBtn" type="submit" value="register">
		<p> <a href="index.php"> Back to log in</a></p>
	</div>
</form>
</div>

</body>
</html>
