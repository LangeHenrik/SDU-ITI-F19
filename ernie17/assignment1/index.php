<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if(isset($_POST["login-username"]) && isset($_POST["login-password"])) {
		if($_POST["login-username"] === "Henrik" && $_POST["login-password"] === "Lange") {
			$_SESSION["username"] = $_POST["user"];
			$_SESSION["login"] = true;
			header('location: pictures.php');
		} else {
			echo "wrong";
			$_SESSION["loginResult"] = "Wrong username og password!";
		}
	}
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
            <form class="form-login" method="post">
                <fieldset>
                    <legend>Login:</legend>
                    <input type="text" name="login-username" id="login-username" placeholder="Username"><br><br>
                    <input type="password" name="login-password" id="login-password" placeholder="Password"><br><br>
					<button name="btn-login">Login</button>
                </fieldset>
            </form>
			<?php
				if(isset($_SESSION["loginResult"])) {
					echo "<p>" . $_SESSION["loginResult"] . "</p>";
					#echo "<p>ERROR</p>";
				}
			?>
        </div>
        <div class="register">
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
