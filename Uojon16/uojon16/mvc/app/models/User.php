<?php
class User extends Database {
	
	public $username;
	public $password;
	public $firstname;
	public $lastname;
	public $zip;
	public $city;
	public $email;
	public $phonenumber;
	
	
	public function loginUser($user) {
		$getPw = $this->conn->prepare("SELECT password FROM user WHERE username=:username");
		$getPw->bindParam(':username', $user);
		$getPw->execute();
		$temp = $getPw->fetch();
		$tempPw = $temp['password'];
		$conn = null;
		return $tempPw;
	}
	public function getUserID($user) {
        $getID = $this->conn->prepare("SELECT user_id FROM user WHERE username=:username");
        $getID->bindParam(':username', $user);
        $getID->execute();
        $temp = $getID->fetch();
        $tempID = $temp['user_id'];
        $conn = null;
        return $tempID;
    }
	
	public function listAll() {
		
		
		$getUsers = $this->conn->prepare("SELECT username FROM user");
		
		$getUsers->execute();
		$getUsers->setFetchMode(PDO::FETCH_ASSOC);
		$tempUsers = $getUsers->fetchAll();
		
		$conn = null;
		return $tempUsers;
	}

	public function createUser() {
		
		
		$postUser = $this->conn->prepare("INSERT INTO user (username, password, firstname, lastname, zip, city, email, phonenumber) VALUES (:username, :password, :firstname, :lastname, :zip, :city, :email, :phone);");
		$postUser->bindParam(':username', $_POST['username']);
		$postUser->bindParam(':password', $_POST['password']);
		$postUser->bindParam(':firstname', $_POST['firstname']);
		$postUser->bindParam(':lastname', $_POST['lastname']);
		$postUser->bindParam(':zip', $_POST['zip']);
		$postUser->bindParam(':city', $_POST['city']);
		$postUser->bindParam(':email', $_POST['email']);
		$postUser->bindParam(':phone', $_POST['phonenumber']);
		$postUser->execute();
		
		$conn = null;
		}
		 public function apiGetUsers() {
        $st = $this->conn->prepare("SELECT user_id, username FROM user;");
        $st->execute();
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $result = $st->fetchAll();
        return $result;
    }
	
	//mangler
	public function getALLUsers(){
		$sql = "SELECT user_id, username FROM user";
		$stmt = $this-> conn-> prepare($sql);
		$stmt -> execute();
		$tempUsers = $stmt-> fetchAll();
		
		$conn = null;
		return $tempUsers;
		
	}
	
    public function apiValidateUsers($username, $password) {
        $st = $this->conn->prepare("SELECT user_id, password FROM user WHERE username = :username;");
        $st->bindparam(':username', $username);
        $st->execute();
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $result = $st->fetchAll();
        if ($password == $result[0]['password']) {
            
			$_SESSION['logged_in'] = true;
			$_SESSION['user_id'] = $result[0]['user_id'];
			return $result[0]['user_id'];
        } else {
            return 'Error';
        }
    }
		
		
}
   