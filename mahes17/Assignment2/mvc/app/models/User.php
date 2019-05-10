<?php
class User extends Database {

	public function login($email, $password){ 

		$sql = "SELECT email, userPassword FROM person WHERE email = :email";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam('email', $email);
		$stmt->execute();
		$users = $stmt->fetchAll();

		if(isset($users[0]) && sizeof($users) == 1 && $users[0]['email'] == $email) {

			if($users[0]['userPassword'] == $password) {
				$_SESSION['logged_in'] = true;
				return true;
			}
		}

		return false;
	}

}
