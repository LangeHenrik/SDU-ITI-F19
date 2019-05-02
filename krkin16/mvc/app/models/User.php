<?php
class User extends Database {
	
	public $name;

	public static function registerUser($username, $password, $firstName, $lastName, $zip, $city, $email, $phone) {
		connect();
		global $connection;
		$stmt = $connection->prepare("INSERT INTO users (username, password, first_name, last_name, zip, city, email, phone) VALUES (?, ?, ?, ?,?, ?,?, ?)");
		$hashed = password_hash($password, PASSWORD_BCRYPT);
		$stmt->bind_param("ssssisss", $username, $hashed, $firstName, $lastName, $zip, $city, $email, $phone);
		if(!$stmt->execute()) {
			echo $stmt->error;
		}
		
		$stmt->close();
		$connection->close();
	}
	
	public static function authenticate($username, $password) {
		connect();
		global $connection;
		$stmt = $connection->prepare("SELECT password from users WHERE username = ?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		
		$isLegit = false;
		
		while($row = $result->fetch_assoc()) {
			$isLegit = password_verify($password, $row["password"]);
		}
		
		return $isLegit;
	}
	
	public static function getId($username) {
		connect();
		global $connection;
		$stmt = $connection->prepare("SELECT id from users WHERE username = ?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		
		while($row = $result->fetch_assoc()) {
			return $row["id"];
		}
	}
	
	public static function getUser($id=null) {
		connect();
		global $connection;
		if($id!==null) {
			$stmt = $connection->prepare("SELECT username from users WHERE id = ?");
			$stmt->bind_param("i", $id);$stmt->execute();
			$result = $stmt->get_result();

			while($row = $result->fetch_assoc()) {
				return $row["username"];
			}
		} else {
			$result = $connection->query("SELECT username, id from users;");
			$entries = array();
			$count=0;

			while($row = $result->fetch_assoc()) {
				$entries[$count] = new stdClass();
				$entries[$count]->user_id = $row["id"];
				$entries[$count]->username = $row["username"];
				
				$count++;
			}
			return $entries;
		}    
	}
}