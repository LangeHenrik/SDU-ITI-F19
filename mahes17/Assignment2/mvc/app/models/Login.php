<?php

require_once ("../core/Database.php");

class Login extends Database {

  public function loginUser() {

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

}
