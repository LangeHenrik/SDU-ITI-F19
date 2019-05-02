<?php
class User extends Database {
	
	public function login($username, $password){

		$sql = "SELECT * FROM users WHERE username = :username";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$users = $stmt->fetch();

		if($users['username'] == $username && password_verify($password,$users['pwd'])) {
			echo "Username correct and password correct";
			
				$_SESSION['logged_in'] = true;
				echo "Password correct";
				
				// Stores data in session
				$_SESSION['id'] = $users['id'];
                $_SESSION["username"] = $username;
                $_SESSION["firstname"] = $users["firstname"];
                $_SESSION["lastname"] = $users["lastname"];
                $_SESSION["zipcode"] = $users["zipcode"];
                $_SESSION["city"] = $users["city"];
                $_SESSION["email"] = $users["email"];
                $_SESSION["phonenumber"] = $users["phonenumber"];
				header('Location: /peten17/mvc/public/picture/all');
				
			} else{
			echo "Wrong password or username";
			
		}

		
	}

	public function getUsers(){
		$sql = $this->conn->prepare("SELECT * FROM users");
		$sql->execute();
	 	$sql->setFetchMode(PDO::FETCH_ASSOC);
		$users = $sql->fetchAll();
		  
		return $users;
	}

	public function register($username, $password, $firstname, $lastname, $zipcode, $city, $email, $phonenumber){
		$_SERVER['register_msg'] = "";
		$checkUsername = $this->conn->prepare("SELECT user_id FROM users where username = :username");
		$addUsersql = 	 $this->conn->prepare("INSERT INTO users (username, pwd, firstname, lastname, zipcode, city, email, phonenumber) VALUES (:username, :pwd, :firstname, :lastname, :zipcode, :city, :email, :phonenumber);");
		
		$checkUsername->bindParam(":username", $username, PDO::PARAM_STR);

		$checkUsername->execute();
		$checkUsername->setFetchMode(PDO::FETCH_ASSOC);
		$users = $checkUsername->fetchAll();
	
		  
		if(count($users)==1){
			//$_SESSION['register_msg'] = "Username already taken. Pick another!";
			echo "User already exists";
			

		} else {
			$param_pass = password_hash($password,PASSWORD_DEFAULT);// Hashing the password for safety

			$addUsersql->bindParam(":username",$username,PDO::PARAM_STR);
			$addUsersql->bindParam(":pwd",$param_pass,PDO::PARAM_STR);
			$addUsersql->bindParam(":firstname",$firstname,PDO::PARAM_STR);
			$addUsersql->bindParam(":lastname",$lastname,PDO::PARAM_STR);
			$addUsersql->bindParam(":zipcode",$zipcode,PDO::PARAM_INT);
			$addUsersql->bindParam(":city",$city,PDO::PARAM_STR);
			$addUsersql->bindParam(":email",$email,PDO::PARAM_STR);
			$addUsersql->bindParam(":phonenumber",$phone,PDO::PARAM_STR);
					

			$addUsersql->execute();
			$_SESSION['register_msg'] = "Registration successful.";
			$_SESSION['logged_in'] = true;
			
			$_SESSION["username"] = $username;
			$_SESSION["firstname"] = $username;
			$_SESSION["lastname"] = $lastname;
			$_SESSION["zipcode"] =$zipcode;
			$_SESSION["city"] = $city;
			$_SESSION["email"] = $email;
			$_SESSION["phonenumber"] = $phonenumber;
			header('Location: /peten17/mvc/public/picture/all');
			
		}
			
		
	}

	public function apiUsers(){
		$sql = $this->conn->prepare("SELECT username,user_id FROM users;");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$users = $sql->fetchAll();
		return $users;
	}


	public function validateUser($username,$password){
		$sql = $this->conn->prepare("SELECT user_id, pwd FROM users WHERE username = :username");
		$sql->bindparam(':username', $username);
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sql->fetch();
		if (password_verify($password, $result['pwd'])) {
			echo "approved";
			return $result['user_id'];
		} else {
			echo "not approved";
			return 'error';
		}
	}






}