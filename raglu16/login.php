<?php

require "header.php";
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	echo "You are already logged in.";
}
 
require_once "config.php";
 
$username = $password = "";
$username_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	$sql = "SELECT id, username, password FROM users WHERE username = :username";
	
	if($stmt = $conn->prepare($sql)){
		
		$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
        $param_username = trim($_POST["username"]);
		
		if($stmt->execute()){
			if($stmt->rowCount() == 1){
				if($row = $stmt->fetch()){
					$id = $row["id"];
					$username = $row["username"];
					$password = $row["password"];
					if($password == trim($_POST["password"])){
						session_start();
						
						$_SESSION["loggedin"] = true;
						$_SESSION["id"] = $id;
						$_SESSION["username"] = $username;                            
						
						header("location: pictures.php");
					} else{
						echo "The password you entered was not valid.";
					}
				}
			} else{
				echo "No account found with that username.";
			}
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}
	}

	unset($conn);
	unset($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<input type="text" name="username" placeholder="Username" required> <br>
		<input type="password" name="password" placeholder="Password" required><br>
		<button type="submit" name="login-submit">Login</button>
	</form>
	<p>Don't have an account? <a href="register.php">Register here</a></p>
</body>