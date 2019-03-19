<?php
	# Starty session
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	# Clean up
	if (isset($_SESSION["loginResult"])) {
		unset($_SESSION["loginResult"]);
	}

	if (isset($_SESSION["registerResult"])) {
		unset($_SESSION["registerResult"]);
	}

	# establish db connection
	require_once 'db_config.php';

	try {

		$conn = new PDO("mysql:host=$servername;dbname=$dbname",
		$username,
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		$stmtGetUsers = $conn->prepare("SELECT username, pass FROM picture_user");
		$stmtAddUser = $conn->prepare("INSERT INTO picture_user (username, pass, firstname, lastname, zip, city, email, phone) VALUES (:username, :pass, :firstname, :lastname, :zip, :city, :email, :phone)");

		$stmtGetUsers->execute();
		$stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
		$resultGetUsers = $stmtGetUsers->fetchAll();
		// print_r($resultGetUsers);

	} catch (PDOexception $e) {
		echo "Error: " . $e->getMessage();
	}

	# Check login input
	if(isset($_POST["login-username"]) && isset($_POST["login-password"])) {
		$inputUsername = htmlentities(filter_input(INPUT_POST, "login-username", FILTER_SANITIZE_STRING));
		$inputPassword = htmlentities(filter_input(INPUT_POST, "login-password", FILTER_SANITIZE_STRING));

		foreach ($resultGetUsers as $value) {
			#print_r("<br>username: " . $value["username"] . " password: " . $value["pass"]);
			if ($inputUsername === $value["username"] && $inputPassword === $value["pass"]) {
				$_SESSION["username"] = $inputUsername;
				$_SESSION["login"] = true;
				header('location: pictures.php');
			}
		}

		$_SESSION["loginResult"] = "Wrong username og password!";
	}

	# Check register input
	if(isset($_POST["register-username"])) {
		$inputUsername = htmlentities(filter_input(INPUT_POST, "register-username", FILTER_SANITIZE_STRING));

		foreach ($resultGetUsers as $value) {
			if ($inputUsername === $value["username"]) {
				$_SESSION["registerResult"] = "Username allready taken!";
				break;
			}
		}

		$inputPassword = htmlentities(filter_input(INPUT_POST, "register-password", FILTER_SANITIZE_STRING));
		$inputPasswordRepeat = htmlentities(filter_input(INPUT_POST, "register-password-repeat", FILTER_SANITIZE_STRING));

		if (!isset($_SESSION["registerResult"]) && $inputPassword !== $inputPasswordRepeat) {
			$_SESSION["registerResult"] = "Passwords doesn't match!";
		}

		$inputFirstname = htmlentities(filter_input(INPUT_POST, "register-firstname", FILTER_SANITIZE_STRING));
		$inputLastname = htmlentities(filter_input(INPUT_POST, "register-lastname", FILTER_SANITIZE_STRING));
		$inputZip = htmlentities(filter_input(INPUT_POST, "register-zip", FILTER_SANITIZE_NUMBER_INT));
		$inputCity = htmlentities(filter_input(INPUT_POST, "register-city", FILTER_SANITIZE_STRING));
		$inputEmail = htmlentities(filter_input(INPUT_POST, "register-email", FILTER_SANITIZE_EMAIL));
		$inputPhone = htmlentities(filter_input(INPUT_POST, "register-phone", FILTER_SANITIZE_NUMBER_INT));

		// If input => create new user
		if (!isset($_SESSION["registerResult"])) {
			if ($inputUsername !== "" && $inputPassword !== "" && $inputFirstname !== ""
			 && $inputLastname !== "" && $inputZip !== "" && $inputCity !== ""
			  && $inputEmail !== "" && $inputPhone !== "") {

				try {
					$stmtAddUser->bindparam(':username', $inputUsername);
					$stmtAddUser->bindparam(':pass', $inputPassword);
					$stmtAddUser->bindparam(':firstname', $inputFirstname);
					$stmtAddUser->bindparam(':lastname', $inputLastname);
					$stmtAddUser->bindparam(':zip', $inputZip);
					$stmtAddUser->bindparam(':city', $inputCity);
					$stmtAddUser->bindparam(':email', $inputEmail);
					$stmtAddUser->bindparam(':phone', $inputPhone);

					$stmtAddUser->execute();
					$stmtAddUser->setFetchMode(PDO::FETCH_ASSOC);
					$resultAddUser = $stmtAddUser->fetchAll();

				} catch (PDOexception $e) {
					echo "Error: " . $e->getMessage();
				}
			}
		}

	}

	# Close db connection
	$conn = null;
?>

<html>
	<head>
		<title>Assignment 1</title>
        <meta name="viewport" content="width=device-witdh, initial-scale=1.0">
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	</head>

	<body>
  		<h2 class="title">Welcome to an awesome picture place!</h2>
		<div class="login">
			<?php
				if(isset($_SESSION["loginResult"])) {
					echo "<p class='error-response'>" . $_SESSION["loginResult"] . "</p>";
				}
			?>
            <form class="form-login" method="post">
                <fieldset>
                    <legend>Login</legend>
                    <input type="text" name="login-username" id="login-username" placeholder="Username"><br><br>
                    <input type="password" name="login-password" id="login-password" placeholder="Password"><br><br>
					<button name="btn-login">Login</button>
                </fieldset>
            </form>
        </div>
        <div class="register">
			<?php
				if(isset($_SESSION["registerResult"])) {
					echo "<p class='error-response'>" . $_SESSION["registerResult"] . "</p>";
				}
			?>
			<p style="display: none" class="error-response" id="js-response" style="color: #F00">test</p>
            <form class="form-register" method="post" onsubmit="return checkRegisterFields()" action="index.php">
                <fieldset>
                    <legend>Register</legend>
                    <p>Username</p>
                    <input type="text" name="register-username" id="register-username" required><br><br>
                    <p>Password</p>
                    <input type="password" name="register-password" id="register-password" required><br><br>
                    <p>Repeat Password</p>
                    <input type="password" name="register-password-repeat" id="register-password-repeat" required><br><br>
                    <p>Firstname</p>
                    <input type="text" name="register-firstname" id="register-firstname" required><br><br>
                    <p>Lastname</p>
                    <input type="text" name="register-lastname" id="register-lastname" required><br><br>
                    <p>Zip</p>
                    <input type="text" name="register-zip" id="register-zip" required><br><br>
                    <p>City</p>
                    <input type="text" name="register-city" id="register-city" required><br><br>
                    <p>Email</p>
                    <input type="text" name="register-email" id="register-email" required><br><br>
                    <p>Phone number</p>
                    <input type="text" name="register-phone" id="register-phone" required><br><br>
					<button name="btn-register">Register</button>
                </fieldset>
            </form>
        </div>
	</body>
</html>
