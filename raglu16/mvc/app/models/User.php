<?php
class User extends Database {
	

	public function login($username, $password){

		$sql = "SELECT user_id, username, password FROM users WHERE username = :username";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam('username', $username);
		$stmt->execute();
		$users = $stmt->fetchAll();

		if(isset($users[0]) && sizeof($users) == 1 && $users[0]['username'] == $username) {
			
			if($users[0]['password'] == $password) {
				$_SESSION['logged_in'] = true;
				$_SESSION['user_id'] = $users[0]['user_id'];
				return true;
			}

		}

		return false;
	}
	
	public function getAllUsers(){
		$sql = "SELECT user_id, username FROM users";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$users = $stmt->fetchAll();
		
		return $users;
	}
	
}