<?php

class User extends Database {

	public $name;

	public function login($username, $password) {
		$sql											= "SELECT * FROM login WHERE login_username = :username";
		$stmt 										= $this->conn->prepare($sql);
		$stmt->execute(
			array(
				'username' => $username,
			)
		);
		$result = $stmt->fetchAll();
		if (isset($result[0]) && sizeof($result) >= 1 && $result[0]['login_username'] == $username) {
			// Hashing password in order to check if the password is correct

			$verification = password_verify();
			if (password_verify($password, $result[0]['login_password'])) {
				$_SESSION['logged_in'] 	= true;
				$_SESSION['username'] 	= $result[0]['login_username'];
				$_SESSION["email"] 			= $result[0]["login_email"];
				$_SESSION["name"] 			= $result[0]["login_name"];
				$_SESSION["phone"] 			= $result[0]["login_phone"];
				$_SESSION["zip"] 				= $result[0]["login_zip"];
				$_SESSION["city"] 			= $result[0]["login_city"];
				return true;
			} else {
				$_SESSION['msg'] = "Incorrect login";
			}
		}
		return false;
	}

	public function getAllUsers() {
		$sql											= "SELECT * FROM login";
		$stmt 										= $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

		return $result;
	}
}
