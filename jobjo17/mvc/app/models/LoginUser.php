<?php
class LoginUser extends Database {

	public $user_name;
	public $password;

	public function create($input1,$input2) {
		// attempt at fixing weird error
		$this->user_name = filter_var($input1,FILTER_SANITIZE_STRING);
		$this->password = filter_var($input2,FILTER_SANITIZE_STRING);
		
	}
	public function login() {
		$stmt = $this->conn->prepare("SELECT username,password,id FROM users WHERE username=:username");
		$stmt->bindParam(':username', $this->user_name);
		$stmt->execute();
		$temp = $stmt->fetch();	
		if($temp != null) {
			if(password_verify($this->password,$temp['password'])) {
				$_SESSION['logged_in'] = true;
				$_SESSION['user_id'] = $temp['id'];
				$_SESSION['user_name'] = $temp['username'];
				return true;
			} else {
				$_SESSION['error'] = "Wrong username or password";
				return false;
		}} else {
			$_SESSION['error'] = "Wrong username or password";
			return false;
		}		
	}
	
	public function logout() {
		unset($_SESSION['logged_in']);
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
	}

}