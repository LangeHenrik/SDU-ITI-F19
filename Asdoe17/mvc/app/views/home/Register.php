<!DOCTYPE html>
<html>
	<head>
		<title>Register new user</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!-- <link rel="shortcut icon" type="image/png" href="/favicon.png"/> -->
			<script src="/Asdoe17/mvc/public/js/RegisterUser.js"></script>
			<link rel="stylesheet" type="text/css" href="/Asdoe17/mvc/public/css/style.css">
	</head>
	<body>

			<div class="Register">
				<form action="/Asdoe17/mvc/public/Register/register" method="POST" onsubmit="return checkFields()" enctype='multipart/form-data'>
					<label for="username">Username</label>
					<br>
					<?php if(!$viewbag['user_exists']){ ?>
						<input type='text' name='username' id='username' value='<?=$viewbag['username']?>' />
					<?php } else { ?>
						<input type='text' name='username' id='username' value='<?=$viewbag['username']?>' style='border:2px solid red;'/>
					<?php } ?>
					<br>

					<label for="password">Password</label>
					<br>
					<input type="password" name="password" id="password" />
					<br>

					<label for="password_repeat">Repeat password</label>
					<br>
					<input type="password" name="password_repeat" id="password_repeat" />
					<br>

					<label for="email">Email adress</label>
					<br>
					<?php if(!$viewbag['email_exists']){ ?>
						<input type='text' name='email' id='email' value='<?=$viewbag['email']?>' />
					<?php } else { ?>
						<input type='text' name='email' id='email'  value='<?=$viewbag['email']?>' style='border:2px solid red;'/>
					<?php } ?>
					<br>

					<label for="phone">phone number</label>
					<br>
					<input type="text" name="phone" id="phone" value='<?=$viewbag['phone']?>' />
					<br>

					<label for="zip">zip code</label>
					<br>
					<input type="text" name="zip" id="zip" value='<?=$viewbag['zip']?>' />
					<br>

					<label for="first_name">First name</label>
					<br>
					<input type="text" name="first_name" id="first_name" value='<?=$viewbag['first name']?>' />
					<br>

					<label for="last_name">Last name</label>
					<br>
					<input type="text" name="last_name" id="last_name" value='<?=$viewbag['last name']?>' />
					<br>

					<label for="city">City</label>
					<br>
					<input type="text" name="city" id="city" value='<?=$viewbag['city']?>' />
					<br>

					<label for="image">Choose a profile picture</label>
					<br>
					<input type='file' name='image' />
					<br>

					<input type="submit" name="submit" id="submit" value='register'/>
				</form>
			</div>

	</body>
</html>
