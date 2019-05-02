<?php
class User extends Database {
	
	public $first_name;
	public $last_name;
	public $user_name;
	public $password;
	public $email;
	public $phone;
	public $zip;
	public $city;
	public $image;
	public function filter() {
		$first_name = filter_var($this->first_name,FILTER_SANITIZE_STRING);
		$last_name = filter_var($this->last_name,FILTER_SANITIZE_STRING);
		$user_name = filter_var($this->user_name,FILTER_SANITIZE_STRING);
		$password = filter_var($this->password,FILTER_SANITIZE_STRING);
		$email = filter_var($this->email,FILTER_SANITIZE_EMAIL);
		$phone = filter_var($this->phone,FILTER_SANITIZE_NUMBER_INT);
		$zip = filter_var($this->zip,FILTER_SANITIZE_NUMBER_INT);
		$city = filter_var($this->city,FILTER_SANITIZE_STRING);
	}
	public function setImage($input1){
		
	}
	public function retrieveAll() {
		$users = array();
		$stmt = $this->conn->prepare("SELECT username, first_name,last_name,zip,city,email,phonenumber from users");

		$results = array();
		if ($stmt->execute()) {
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$results[] = $row;
		}
}		
		foreach($results as $result) {
			$tempUser = new User();
			$tempUser->first_name = $result['first_name'];
			$tempUser->last_name = $result['last_name'];
			$tempUser->user_name = $result['username'];
			$tempUser->zip = $result['zip'];
			$tempUser->city = $result['city'];
			$tempUser->email = $result['email'];
			$tempUser->phone = $result['phonenumber'];		
			array_push($users, $tempUser);
		}
		return $users;
	}
	public function register() {
		$this->filter();
		$stmt = $this->conn->prepare("INSERT INTO users(username,password,first_name,last_name,zip,city,email,phonenumber) 
		VALUES(:username,:password,:firstname,:lastname,:zip,:city,:email,:phonenumber)");
		$stmt->bindParam(':username', $this->user_name);
		$hashedPw = password_hash($this->password,PASSWORD_DEFAULT); // hash the password because storing it in clear text is not ideal
		$stmt->bindParam(':password', $hashedPw);
		$stmt->bindParam(':firstname', $this->first_name);
		$stmt->bindParam(':lastname', $this->last_name);
		$stmt->bindParam(':zip', $this->zip);
		$stmt->bindParam(':city', $this->city);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':phonenumber', $this->phone);
		try{
			$stmt->execute();
			$_SESSION['error'] = "Registration successful, you can now log in!";
		} catch(Exception $e) {
			$_SESSION['error'] = "Username already exists";
		}


		
		
		
	}

}