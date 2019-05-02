<?php
class User extends Database {
	
	public function login($username, $password){

		$sql = "SELECT username, password FROM users WHERE username = :username";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam('username', $username);
		$stmt->execute();
		$users = $stmt->fetchAll();

		if(isset($users[0]) && sizeof($users) == 1 && $users[0]['username'] == $username) {
			
			#if($users[0]['password'] == $password) {
			if(password_verify($password,$users[0]['password'])){
				$_SESSION['logged_in'] = true;
				$_SESSION['user']=$username;
				return true;
			}

		}

		return false;
	}
	public function register($username,$password,$fullname){
			$sql = "INSERT into users (username,name,password) values (:username,:fullname,:password);";
			$statement = $this-> conn -> prepare($sql);
			$statement -> bindParam(":username",$username);
			$statement -> bindParam(":fullname",$fullname);
			$statement -> bindParam(":password",$password);
			$statement -> execute();
			
			$_SESSION['logged_in']=true;
			$_SESSION['user'] = $username;
			header('Location: /frfab17/mvc/public/picture/all');
	}

}