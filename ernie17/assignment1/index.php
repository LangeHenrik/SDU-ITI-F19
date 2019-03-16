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

		/*$stmt = $conn->prepare("SELECT * FROM picture_user WHERE Book = :search OR Author = :search OR Publisher = :search");
		$stmt->bindparam(':search', $searchInput);

		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt->fetchAll();*/
		#print_r($result);

		/*$index = 0;
		while (isset(array_values($result)[$index]))
		{
			$row = array_values($result)[$index];
			echo '<tr>';
			echo '<td>' . $row['Book'] . '</td>';
			echo '<td>' . $row['Author'] . '</td>';
			echo '<td>' . $row['Publisher'] . '</td>';
			echo '</tr>';
			$index++;
		}*/

		$stmtGetUsers = $conn->prepare("SELECT username, pass FROM picture_user");
		$stmtAddUser = $conn->prepare("INSERT INTO picture_user (username, pass, firstname, lastname, zip, city, email, phone) VALUES (:username, :pass, :firstname, :lastname, :zip, :city, :email, :phone)");

		$stmtGetUsers->execute();
		$stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
		$resultGetUsers = $stmtGetUsers->fetchAll();
		#print_r($resultGetUsers);

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
	/*if(isset($_POST["register-username"]) && isset($_POST["login-password"])) {
		if($_POST["login-username"] === "Henrik" && $_POST["login-password"] === "Lange") {
			$_SESSION["username"] = $_POST["user"];
			$_SESSION["login"] = true;
			header('location: pictures.php');
		} else {
			$_SESSION["loginResult"] = "Wrong username og password!";
		}
	}*/

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
					echo "<p>" . $_SESSION["loginResult"] . "</p>";
				}
			?>
            <form class="form-login" method="post">
                <fieldset>
                    <legend>Login:</legend>
                    <input type="text" name="login-username" id="login-username" placeholder="Username"><br><br>
                    <input type="password" name="login-password" id="login-password" placeholder="Password"><br><br>
					<button name="btn-login">Login</button>
                </fieldset>
            </form>
        </div>
        <div class="register">
			<?php
				if(isset($_SESSION["registerResult"])) {
					echo "<p>" . $_SESSION["registerResult"] . "</p>";
				}
			?>
            <form class="form-register" method="post" onsubmit="checkRegisterFields()">
                <fieldset>
                    <legend>Register:</legend>
                    <p>Username</p>
                    <input type="text" name="register-username" id="register-username" required><br><br>
                    <p>Password</p>
                    <input type="password" name="register-password" id="register-password"><br><br>
                    <p>Password</p>
                    <input type="password" name="register-password-repeat" id="register-password-repeat"><br><br>
                    <p>Firstname</p>
                    <input type="text" name="register-firstname" id="register-firstname"><br><br>
                    <p>Lastname</p>
                    <input type="text" name="register-lastname" id="register-lastname"><br><br>
                    <p>Zip</p>
                    <input type="text" name="register-zip" id="register-zip"><br><br>
                    <p>City</p>
                    <input type="text" name="register-city" id="register-city"><br><br>
                    <p>Email</p>
                    <input type="text" name="register-email" id="register-email"><br><br>
                    <p>Phone number</p>
                    <input type="text" name="register-phone" id="register-phone"><br><br>
					<button name="btn-register">Register</button>
                </fieldset>
            </form>
        </div>
	</body>
</html>
