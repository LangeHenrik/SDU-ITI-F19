<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css">
		<script src="script.js"></script>

		</script>
		<title>sign-up</title>
	</head>
	<body>
		<header>
			<div class="container">
				<div class="logo">
					<img src="img/logo.png" height="50" alt="" title="">
				</div>

				<nav>
					<li><a href="pictures.php">Pictures</a></li>
					<li><a href="about.php">About</a></li>
				</nav>
				</div>
			</div>
		</header>

		<br><br><br>

		<main>
			<form method="post" action="login.php">
				<fieldset>
				<legend><h3>Sign up</h3></legend>
					<form action="login.php" method="post">
						<label for="Name" id="lname">Name</label>
						<br>
						<input onblur="checkName()" type="name" name="name" id="name" placeholder="Fullname here.."/>
						<br>
						<label for="email" id="lemail">E-mail</label>
						<br>
						<input onblur="checkEmail()" type="text" name="email" id="email" placeholder="E-mail here.."/>
						<br>
						<label for="password" id="lpassword">Password</label>
						<br>
						<input onblur="checkPassword()" type="password" name="password" id="password" placeholder="Password here.."/>
						<br><br>
						<input onsubmit="saveUser()" type="submit" name="submit" id="submit"/>
						<br><br>
				</form>
			</fieldset>
		</form>
		</main>

	</body>
</html>
