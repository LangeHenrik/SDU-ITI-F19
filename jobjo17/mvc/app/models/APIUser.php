<?php
// defines what user info to retrieve & send to api requests
class APIUser extends Database {
	
	public $user_id;
	public $username;
	

	public function retrieveAll() {
		$users = array();
		$stmt = $this->conn->prepare("SELECT username,id from users");

		$results = array();
		if ($stmt->execute()) {
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$results[] = $row;
		}
}		
		foreach($results as $result) {
			$tempUser = new APIUser();
			$tempUser->user_id= $result['id'];
			$tempUser->username = $result['username'];
			array_push($users, $tempUser);
		}
		return $users;
	}
	}

