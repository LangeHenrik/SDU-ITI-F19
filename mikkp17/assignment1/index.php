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
	<h1>Login or sign up</h1>
	<input name="username" type="text" class="login_fields" placeholder="Username"/><br>
	<input name="password" type="password" class="login_fields" placeholder="Password"/><br>
	<input type="submit" id="login_btn" value="Login"></br>
	
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
			echo '<br> <div class="login_error">Please enter a username!</div>';
		}else if(empty($result[0])){
			echo '<br> <div class="login_error">Username does not exist!</div>';
		}else if(password_verify($password, $result[0])){
			$_SESSION['user'] = $username;
			header("Location: imgfeed.php");
		}else{
			echo '<br> <div class="login_error">Wrong password!</div>';
		}
	}
	?>
	<p style="font-size: larger">Not signed up? <a href="signup.php"> Click here to do so!</a></p>
</form>
</div>

</body>
</html>