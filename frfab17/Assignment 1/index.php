<?php
require_once "db_config.php";
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment 1</title>
</head>
<body>
<div>
    <form  method="post">
        <h1>Login or register</h1>
        <input name="username" type="text"  placeholder="Username"/><br>
        <input name="password" type="password" placeholder="Password"/><br>
        <input type="submit" id="login_button" value="Login"/><br>
        <p style="font-size: larger">If you don't have a user registered, then <a href="register.php">click here to
            register</a></p>

        <?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$sql = "SELECT password FROM user WHERE username = :username;";
		$statement = $con -> prepare($sql);
		$statement -> bindParam(':username', $username);
		$statement -> execute();
		
		$result = $statement -> fetch(PDO::FETCH_NUM);
		if(empty(!$username) && empty(!$password)){
			if($password == $result[0]){
				$_SESSION['user']=$username;
				header("Location: imagepage.php");
			}else{
				echo '<br> <div>Your username or password was wrong</div>';
			}
		}else{
			echo '<br><div>Please enter username AND password</div>';
		}
		
	}
	?>
    </form>
</div>
</body>
</html>
