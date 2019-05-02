<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!-- <link rel="shortcut icon" type="image/png" href="/favicon.png"/> -->
			<script src="/Asdoe17/mvc/public/js/Login.js"></script>
			<link rel="stylesheet" type="text/css" href="/Asdoe17/mvc/public/css/style.css">
	</head>
	<body>
		<?php include '../app/views/partials/menu.php'; ?>


			<div class='Login' id='login'>
				<form action="/Asdoe17/mvc/public/Login/login" method="post" onsubmit="return checkFields()">
					<br>
					<?php if($viewbag['userbox_correct']){?>
						<label for="username">Username</label>
						<br>
						<input type="text" name="username" id="username" value='<?=$viewbag['username']?>' />
					<?php } else { ?>
						<label for="username">Username doesn't exist</label>
						<br>
						<input type="text" name="username" id="username" style="border:2px solid red;"/>
					<?php } ?>
					<br>
					<?php if($viewbag['passwordbox_correct']){ ?>
						<label for="password">Password</label>
						<br>
						<input type="password" name="password" id="password"/>
					<?php } else { ?>
						<label for="password">Invalid password</label>
						<br>
						<input type="password" name="password" id="password" style="border:2px solid red;"/>
					<?php } ?>
					<br>
					<input type="submit" name="submit" id="submit" value='Login'/>
				</form>
				<a href="/Asdoe17/mvc/public/Register" class='button'> Register </a>
			</div>


	</body>
</html>
