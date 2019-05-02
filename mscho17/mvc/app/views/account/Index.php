<?php 
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="/mscho17/mvc/public/css/styles.css">
<script src="/mscho17/mvc/public/scrips/loginscripts.js"></script>
</head>
<body>
<div>
	<?php include '../app/views/partials/topBar.php'; ?>
	
<div class="login_screen">
		<div class="login_screen">
		<form method="POST" onsubmit="return checkLogin()" id="login" action="account/login"  >
			<label>username</label>
			<input type="text" name="username" id="login_username"/>
			<br>
			<label>password</label>
			<input type="password" name="password" id="login_password"/>
			<br>
			<input type="submit" name="login"/>
		</form>
	</div>
<div class="login_screen">
	<div class="login_screen">
		<form method="POST" onsubmit="return checkRegister()" id="register" action="account/register" >
			<label>username</label>
			<input type="text" name="username" id="register_username"/>
			<br>
			<label>password</label>
			<input type="password" name="password" id="register_password"/>
			<br>
			<label>repeat password</label>
			<input type="password" name="repeatPassword" id="repeatPassword"/>
			<br>
			<label>email</label>
			<input type="email" name="email" id="email"/>
			<br>
			<label>first name</label>
			<input type="text" name="firstName" id="firstName"/>
			<br>
			<label>last name</label>
			<input type="text" name="lastName" id="lastName"/>
			<br>
			<label>zip code</label>
			<input type="number" name="zipCode" id="zipCode"/>
			<br>
			<label>city</label>
			<input type="text" name="city" id="city"/>
			<br>
			<label>phone number</label>
			<input type="number" name="phoneNumber" id="phoneNumber"/>
			<br>
			<input type="submit" name="register"/>
		</form>		
	
	</div>
</div>
</div>
	
</div>

<div>
</div>


	</body>
</html>

