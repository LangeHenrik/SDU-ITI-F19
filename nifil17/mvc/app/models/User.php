<?php

class User extends Database {

	public $user_id;
	public $username;
	public $first_name;
	public $last_name;
	public $zip;
	public $city;
	public $email;
	public $number;

	public function getUsers() {
		$users = array();
		$st = $this->conn->prepare("SELECT userid,username,firstname,lastname,zip,city,email,number FROM user;");
		$results = array();
		if ($st->execute()) {
			while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
				$results[] = $row;
			}
		}
		foreach($results as $result) {
			$user = new User();
			$user->user_id = $result['userid'];
			$user->username = $result['username'];
            $user->first_name = $result['firstname'];
            $user->last_name = $result['lastname'];
            $user->zip = $result['zip'];
            $user->city = $result['city'];
            $user->email = $result['email'];
            $user->number = $result['number'];
            array_push($users, $user);
       }
	   return $users;
	}
	
	public function apiGetUsers() {
		$st = $this->conn->prepare("SELECT userid AS user_id, username FROM user;");
		$st->execute();
		$st->setFetchMode(PDO::FETCH_ASSOC);
		$result = $st->fetchAll();
		return $result;
	}
	
	public function apiValidateUsers($username, $password) {
		$st = $this->conn->prepare("SELECT userid, password_hash FROM user WHERE username = :username;");
		$st->bindparam(':username', $username);
		$st->execute();
		$st->setFetchMode(PDO::FETCH_ASSOC);
		$result = $st->fetchAll();
		if (password_verify($password, $result[0]['password_hash'])) {
			return $result[0]['userid'];
		} else {
			return 'Error';
		}
	}
}
