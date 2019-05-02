<?php
class User extends Database {

	public function getUsers() {
		$query = $this->conn->prepare("SELECT * FROM users;");
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$users = $query->fetchAll();

		return $users;
	}

	public function getUserByID($user_id) {
		$query = $this->conn->prepare("SELECT * FROM users WHERE user_id = :user_id;");
		$query->bindParam(':user_id',$user_id);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$user = $query->fetchAll();

		return $user[0];
	}

	public function getUserList() {
		$query = $this->conn->prepare("SELECT username, user_id FROM users;");
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$users = $query->fetchAll();

		return $users;
	}

	public function getPassword($username){
		$query = $this->conn->prepare("SELECT user_password FROM users WHERE username = :username;");
		$query->bindParam(':username',$username);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$result = $query->fetchAll();

		return $result[0]['user_password'];
	}

	public function getID($username){
		$query = $this->conn->prepare("SELECT user_id FROM users WHERE username = :username;");
		$query->bindParam(':username',$username);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$result = $query->fetchAll();

		return $result[0]['user_id'];
	}

	public function userExists($username){
		$check_username = $this->conn->prepare("SELECT username FROM users WHERE username = :username;");
		$check_username->bindParam(':username',$username);
		$check_username->execute();
		$check_username->setFetchMode(PDO::FETCH_ASSOC);
		$result = $check_username->fetchAll();

		return !empty($result);
	}

	public function emailExists($email){
		$check_email = $this->conn->prepare("SELECT user_email FROM users WHERE user_email = :email;");
		$check_email->bindParam(':email',$email);
		$check_email->execute();
		$check_email->setFetchMode(PDO::FETCH_ASSOC);
		$result = $check_email->fetchAll();

		return !empty($result);

	}

	public function addUser($post_username, $passwordHash, $email, $phone, $zip, $first_name, $last_name, $city, $image){
		$stmt = $this->conn->prepare("INSERT INTO users(username, user_password, user_email, user_phonenumber, user_zipcode, user_firstname, user_lastname, city, picture) VALUES(:username, :passwordHash, :email, :phone, :zip, :firstName, :lastName, :city, :image);");

		$stmt->bindParam(':username',$post_username);
		$stmt->bindParam(':passwordHash',$passwordHash);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':phone',$phone);
		$stmt->bindParam(':zip',$zip);
		$stmt->bindParam(':firstName',$first_name);
		$stmt->bindParam(':lastName',$last_name);
		$stmt->bindParam(':city',$city);
		$stmt->bindParam(':image', $image);

		$stmt->execute();
	}

}
?>
