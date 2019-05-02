<?php
class User extends Database {
	
		public function getUsers(){
		
		$stmt = $this->conn->prepare("SELECT user_id, username FROM user_login");
		$stmt -> execute();
		$result = $stmt->fetchAll();
		return $result;
		}
		
		public function getUserID($username){
			
			$sanitiedUsername = filter_var($username, FILTER_SANITIZE_STRING);
		
		$stmt = $this->conn->prepare("SELECT user_id FROM user_login where username = '$sanitiedUsername'");
		$stmt -> execute();
		$result = $stmt->fetchAll();
		if(isset($result[0]["user_id"])){
		return $result[0]["user_id"];
		}
		$result = -1;
		return $result;
		}
		
		public function getUsername($userid){
			
			$sanitiedUsername = filter_var($username, FILTER_SANITIZE_STRING);
		
		$stmt = $this->conn->prepare("SELECT username FROM user_login where user_id = '$userid'");
		$stmt -> execute();
		$result = $stmt->fetchAll();
		if(isset($result[0]["username"])){
		return $result[0]["username"];
		}
		$result = -1;
		return $result;
		}
		
		public function authenticateUser($username, $userid, $password){
			

			$stmt = $this->conn->prepare("SELECT * FROM user_login");
			$stmt -> execute();
			$result = $stmt->fetchAll();
			
			// print_r($result);
			
			
			
			$sanitiedUsername = filter_var($username, FILTER_SANITIZE_STRING);
			$sanitiedPassword = filter_var($password, FILTER_SANITIZE_STRING);
			
			
			if(isset($result[0]['user_id']) and $result[0]['user_id'] == $userid){
				// echo "<br/> user id is correct";
			if(isset($result[0]['username']) and $result[0]['username'] == $sanitiedUsername){
			;
				 $check = $result[0]['user_password'];
				
			if( password_verify($password, $check)){
				 // echo "<br/> could authenticate";
				return true;
			}
			}
		}
				 // echo "<br/> could not authenticate";

		return false;
			
		}
		public function authenticateUser2($username, $password){
			

			$stmt = $this->conn->prepare("SELECT * FROM user_login");
			$stmt -> execute();
			$result = $stmt->fetchAll();
			
			// print_r($result);
			
			
			
			$sanitiedUsername = filter_var($username, FILTER_SANITIZE_STRING);
			$sanitiedPassword = filter_var($password, FILTER_SANITIZE_STRING);
			
			
			if(isset($result[0]['username']) and $result[0]['username'] == $sanitiedUsername){
			
				 $check = $result[0]['user_password'];
				
			if( password_verify($password, $check)){

				return $result[0]['user_id'];
			}
			}
		
				 // echo "<br/> could not authenticate";

		return false;
			
		}

		public function registerUser($username, $password, $email){
			
			
			$sanusername = htmlentities(filter_var($username, FILTER_SANITIZE_STRING));
			$sanpassword = htmlentities(filter_var($password, FILTER_SANITIZE_STRING));
			$userEmail = htmlentities(filter_var($email, FILTER_SANITIZE_EMAIL));

			$hashedPassword = password_hash($sanusername, PASSWORD_DEFAULT); 
			
			$stmt = $this->conn->prepare("INSERT INTO user_login (username, user_password, user_email) VALUES (:user_name, :user_password, :user_email)");
			$stmt->bindParam(':user_name', $sanusername);
			$stmt->bindParam(':user_password', $hashedPassword);
			$stmt->bindParam(':user_email', $userEmail);
			$stmt->execute();
			
			return true;
			
		}
}
