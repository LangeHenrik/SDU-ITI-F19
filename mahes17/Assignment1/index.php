<?php
require_once "db_config.php";
session_start();
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="index.css">
</head>

<body>
<div class="login">

<form class="loginForm" method="post">
	<h1>Login</h1>
	<input name="username" type="text" class="inputcss" placeholder="Enter username"/><br>
	<input name="password" type="password" class="inputcss" placeholder="Enter password"/><br>
	<input type="submit" id="login_btn" class="button" value="Login"></br>

	<?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$username = $_POST["username"];
		$password = $_POST["password"];

		$sql = "SELECT password FROM users WHERE username = :username;";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindParam(':username', $username);
		$stmt -> execute();

		$result = $stmt -> fetch(PDO::FETCH_NUM);
		if(empty($username)){
			echo '<br> <div class="login_error">Wrong username/password combination!</div>';
		}else if(password_verify($password, $result[0])){
			$_SESSION['user'] = $username;
			header("Location: users.php");
		}else{
			echo '<br> <div class="login_error">Wrong password!</div>';
		}
	}
	?>
	<p> <a href="register.php"> Register </a>  user </p>
</form>
</div>

</body>
</html>
