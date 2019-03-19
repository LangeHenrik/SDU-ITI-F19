<!DOCTYPE html>
<?php

	session_start();



	// Connect to database
	require_once("db_config.php");
	$object = new db_config_class;
	$db = $object->connect();

	if (isset($_POST['submit_btn'])) {
		if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['name']) &&
					isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['phone']) &&
						isset($_POST['zip']) && isset($_POST['city'])) {

						$username = $_POST['username'];
						$email = $_POST['email'];
						$name = $_POST['name'];
						$password = $_POST['password'];
						$password2 = $_POST['password2'];
						$phone = $_POST['phone'];
						$zip = $_POST['zip'];
						$city = $_POST['city'];

						if ($password === $password2) {
							$query = "SELECT * FROM login WHERE login_username = :username";
							$stmt = $db->prepare($query);
							$stmt->execute(
								array(
									'username' => $_POST["username"],
								)
							);

							$count = $stmt->rowCount();

							if ($count > 0) {
								$_SESSION['message'] = "Username already in use";
							} else {
								// Create user
								// Hashing password using md5(password)
								$query = "INSERT INTO login (login_username, login_email, login_name, login_password, login_phone, login_zip, login_city) VALUES ('$username', '$email', '$name', '$password', $phone, $zip, '$city');";
								$stmt = $db->prepare($query);

								$stmt->execute(
									array(
										'username' => $username,
										'email' => $email,
										'name' => $name,
					          'password' => $password,
										'phone' => $phone,
										'zip' => $zip,
										'city' => $city
									)
								);
								$_SESSION['message'] = "You are now logged in!";
								$_SESSION['username'] = $username;
								header("location: login.php");	// Redirect to login
							}
						} else {
							// Failed to create user
							$_SESSION['message'] = "The two passwords do not match!";
						}
		} else {
			$_SESSION['message'] = "Please enter all fields!";
		}
	}
?>

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
        </div>
    </header>

		<br><br><br>

		<main>
			<form method="post" action="sign-up.php">
				<fieldset>
				<legend><h3>Sign up</h3></legend>
					<form action="login.php" method="post">
						<label for="Name" id="lname">Name</label>
						<br>
						<input onsubmit="checkName()" type="name" name="name" id="name" placeholder="Fullname here.."/>
						<br>

						<label for="username" id="luser">Username</label>
						<br>
						<input onsubmit="checkUsername()" type="username" name="username" id="username" placeholder="Username here.."/>
						<br>

						<label for="email" id="lemail">E-mail</label>
						<br>
						<input onsubmit="checkEmail()" type="text" name="email" id="email" placeholder="E-mail here.."/>
						<br>

						<label for="phone" id="lphone">Phone</label>
						<br>
						<input onsubmit="checkPhone()" type="text" name="phone" id="phone" placeholder="Phone here.."/>
						<br>

						<label for="zip" id="lzip">Zip code</label>
						<br>
						<input onsubmit="checkZip()" type="text" name="zip" id="zip" placeholder="Zip code here.."/>
						<br>

						<label for="city" id="lcity">City</label>
						<br>
						<input onsubmit="checkCity()" type="text" name="city" id="city" placeholder="City here.."/>
						<br>

						<label for="password" id="lpassword">Password</label>
						<br>
						<input onsubmit="checkPassword()" type="password" name="password" id="password" placeholder="Password here.."/>
						<br>

						<label for="password2" id="lpassword2">Verify password</label>
						<br>
						<input onsubmit="checkVerify()" type="password" name="password2" id="password2" placeholder="Password here.."/>
						<br><br>

						<input onsubmit="saveUser()" type="submit" name="submit_btn" id="submit"/>
						<br><br>
				</form>
			</fieldset>
		</form>
		</main>

	</body>
</html>
