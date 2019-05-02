<!DOCTYPE html>
<?php

	session_start();



	// Connect to database
	require_once("db_config.php");
	$object = new db_config_class;
	$db = $object->connect();

	$_SESSION['count'] = 0;

	if (isset($_POST['submit_btn'])) {
		if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['name']) &&
					isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['phone']) &&
						isset($_POST['zip']) && isset($_POST['city'])) {

						// Check username: checks if the username is empty and nothing else.
						$username = htmlentities(filter_var($_POST["username"]),FILTER_SANITIZE_STRING);
						$email = htmlentities(filter_var($_POST["email"]),FILTER_SANITIZE_EMAIL);
						$name = htmlentities(filter_var($_POST["name"]),FILTER_SANITIZE_STRING);
						$password = htmlentities(filter_var($_POST["password"]),FILTER_SANITIZE_STRING);
						$password2 = htmlentities(filter_var($_POST["password2"]),FILTER_SANITIZE_STRING);
						$phone = htmlentities(filter_var($_POST["phone"]),FILTER_SANITIZE_NUMBER_INT);
						$zip = htmlentities(filter_var($_POST["zip"]),FILTER_SANITIZE_STRING);
						$city = htmlentities(filter_var($_POST["city"]),FILTER_SANITIZE_STRING);

						if ($password === $password2) {
							$query = "SELECT * FROM login WHERE login_username = :username";
							$stmt = $db->prepare($query);
							$stmt->execute(
								array(
									'username' => $_POST["username"],
								)
							);

							$_SESSION['count'] = $stmt->rowCount();

							if ($_SESSION['count'] > 0) {
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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
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
				<?php
					if ($_SESSION['count'] > 0) {
						echo "<h2>".$_SESSION['message']."</h2><br>";
					}
				?>
				<fieldset>
				<legend><h3>Sign up</h3></legend>
					<form class="signup" method="post">
						<label for="Name" id="lname">Name</label>
						<br>
						<input onblur="checkName()" type="name" name="name" id="name" placeholder="Fullname here.."/>
						<img src="img/error.png" alt="error" id="ename">
						<br>

						<label for="username" id="luser">Username</label>
						<br>
						<input onblur="checkUsername()" type="username" name="username" id="username" placeholder="Username here.."/>
						<img src="img/error.png" alt="error" id="euser">
						<br>

						<label for="email" id="lemail">E-mail</label>
						<br>
						<input onblur="checkEmail()" type="text" name="email" id="email" placeholder="E-mail here.."/>
						<img src="img/error.png" alt="error" id="eemail">
						<br>

						<label for="phone" id="lphone">Phone</label>
						<br>
						<input onblur="checkPhone()" type="text" name="phone" id="phone" placeholder="Phone here.."/>
						<img src="img/error.png" alt="error" id="ephone">
						<br>

						<label for="zip" id="lzip">Zip code</label>
						<br>
						<input onblur="checkZip()" type="text" name="zip" id="zip" placeholder="Zip code here.."/>
						<img src="img/error.png" alt="error" id="ezip">
						<br>

						<label for="city" id="lcity">City</label>
						<br>
						<input onblur="checkCity()" type="text" name="city" id="city" placeholder="City here.."/>
						<img src="img/error.png" alt="error" id="ecity">
						<br>

						<label for="password" id="lpassword">Password</label>
						<br>
						<input onblur="checkPassword()" type="password" name="password" id="password" placeholder="Password here.."/>
						<img src="img/error.png" alt="error" id="epassword">
						<br>

						<label for="password2" id="lpassword2">Verify password</label>
						<br>
						<input onblur="checkVerify()" type="password" name="password2" id="password2" placeholder="Password here.."/>
						<img src="img/error.png" alt="error" id="everify">
						<br><br>

						<input type="submit" name="submit_btn" id="submit"/>
						<br><br>
				</form>
			</fieldset>
		</form>
		</main>

	</body>
</html>
