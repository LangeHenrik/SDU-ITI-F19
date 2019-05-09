<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		
	}
	
	if (isset($_SESSION["loginResult"])) {
		unset($_SESSION["loginResult"]);

	}



	if (isset($_SESSION["registerResult"])) {
		unset($_SESSION["registerResult"]);

	}

	require_once 'db_config.php';
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",
		$username,
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		$stmtGetUsers = $conn->prepare("SELECT username, password FROM users");
		$stmtCreateUser = $conn->prepare("INSERT INTO users(username, password) VALUES(:username, :password)");
		
		$stmtGetUsers->execute();
		$stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
		$resultGetUsers = $stmtGetUsers->fetchAll();

	} catch (PDOexception $e) {
		echo "Error: " . $e->getMessage();
	}
#Validate login info
	if(isset($_POST["username"]) && isset($_POST["password"])) {
		$inputUsername = htmlentities(filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING));
		$inputPassword = htmlentities(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));

		foreach ($resultGetUsers as $value) {
			#print_r("<br>username: " . $value["username"] . " password: " . $value["password"]);
			if ($inputUsername === $value["username"] && $inputPassword === $value["password"]) {
				$_SESSION["username"] = $inputUsername;
				$_SESSION["login"] = true;
				header('location: home.php');
			}
			else{
				echo "invalid username or password";
			}
		}

		$_SESSION["loginResult"] = "Wrong username og password!";
	}
	
#Validate register info	
	if(isset($_POST["createUsername"])) {
		$inputUsername = htmlentities(filter_input(INPUT_POST, "createUsername", FILTER_SANITIZE_STRING));
		
		foreach ($resultGetUsers as $value) {
			if($inputUsername === $value["username"]){
				$_SESSION["registerResult"] = "Username already in use, please choose another";
				break;
			}
		}
		
		$inputPassword = htmlentities(filter_input(INPUT_POST, "createPassword", FILTER_SANITIZE_STRING));
		
		if (!isset($_SESSION["registerResult"])) {
			try{
				$stmtCreateUser->bindparam(':username', $inputUsername);
				$stmtCreateUser->bindparam(':password', $inputPassword);
				
				$stmtCreateUser->execute();
				$stmtCreateUser->setFetchMode(PDO::FETCH_ASSOC);
				$resultCreateUser = $stmtCreateUser->fetchAll();
				
			}catch(PDOexception $e){
				#echo "Something went wrong " .$e->getMessage();
			}
		}
	}
			
			
	$conn = null;
?>


<html>
<head>
<title>Nifra17 assignment1</title>

	<div class="login">
		<?php
			if(isset($_SESSION["loginResult"])) {
				echo "<p class='error-response'>" . $_SESSION["loginResult"] . "</p>";
			}

		?>

		<form class="form-login" method="post">
			<fieldset>
				<legend>Login</legend>
				<input type="text" name="username" id="username" placeholder="Username"><br><br>
				<input type="password" name="password" id="password" placeholder="Password"><br><br>
				<button name="loginButton">Login</button>
			</fieldset>
		</form>
	</div>
		
		
	<div class="register">
		<?php

			if(isset($_SESSION["registerResult"])) {
				echo "<p class='error-response'>" . $_SESSION["registerResult"] . "</p>";
			}

		?>
		
		<form class="register" method="post">
			<fieldset>
				<legend>Register</legend>
				<input type="text" name="createUsername" id="createUsername" placeholder="Username"><br><br>
				<input type="password" name="createPassword" id="createPassword" placeholder="Password"><br><br>
				<button name="registerButton">Register</button>
			</fieldset>
		</form>
		
	
	</div>

</head>
</html>







