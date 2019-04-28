<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");


class User extends Database {
	public $user, $psw;

	public function checkPassword() {

		if(isset($_POST['username'], $_POST['password'])) {
		    $user = htmlentities($_POST['username']);
			$psw = htmlentities($_POST['password']);
		}


		$sql = "Select * From users WHERE username = :user";

		$stmt = $this->conn->prepare($sql);

		$stmt->bindParam(":user", $user);

		$stmt->execute();

		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if(password_verify($psw, $user['psw'])){ 

			$hashed_password = password_hash($psw, PASSWORD_DEFAULT);
			$_SESSION['username'] = $user;
			$_SESSION['password'] = $hashed_password;

			return true;
	
		} else {
			return false;
	
		}
	}

	public function checkPasswordDB($username, $password) {

		$user = $username;
		$psw = $password;

		$sql = "Select * From users WHERE username = :user";

		$stmt = $this->conn->prepare($sql);

		$stmt->bindParam(":user", $user);

		$stmt->execute();

		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if(password_verify($psw, $user['psw'])){ 

			return true;
	
		} else {
			return false;
	
		}
	}

	public function getAllUsers() {
		$sql = "Select * From users";

		$stmt = $this->conn->prepare($sql);

		$stmt->execute();

		$users = $stmt->fetchAll();

		return $users;
	}

	public function createUser() {

		if (isset($_POST['newusername']) && isset($_POST['passw']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['zip']) && isset($_POST['city'])) {
			//htmlentities for xxs defence
			$newusername = htmlentities($_POST['newusername']);
			$psw = htmlentities($_POST['passw']);
			$fname = htmlentities($_POST['firstname']);
			$lname = htmlentities($_POST['lastname']);
			$phone = htmlentities($_POST['phone']);
			$email = htmlentities($_POST['email']);
			$zip = htmlentities($_POST['zip']);
			$city = htmlentities($_POST['city']);

			$sql = "Select * From users";

			$stmt = $this->conn->prepare($sql);

			$stmt->execute();

			if ($stmt->rowCount() == 0) {
				$user_id = 0;
			} else {
				$user_id = $stmt->rowCount();
			}
	
			//Puts a stock profile picture in the database (in future it could be changed for other uploaded picture)
			$exttype= "image/png";
			$imagetmp= file_get_contents('empty.png');

			//hashing password for storing in DB
			$hashed_password = password_hash($psw, PASSWORD_DEFAULT);
	
			//checks if username is taken

			$sql = "SELECT username FROM users WHERE username = :newusername";

			$stmt = $this->conn->prepare($sql);

			$stmt->bindParam(":newusername", $newusername);

			$stmt->execute();

			if($stmt->rowCount() > 0){

				echo "Username already exists! Please choose another.";
				$_SESSION['usernameExists'] = true;
		
			} else {
				//checks if email is taken
				$sql = "SELECT email FROM users WHERE email = :email";
		
				$stmt = $this->conn->prepare($sql);

				$stmt->bindParam(":email", $email);
	
				$stmt->execute();
		
				if($stmt->rowCount() > 0){
			
					echo "Email already exists!";
					$_SESSION['emailExists'] = true;
			
				} else {
			
					//creates user in DB
					$sql = "INSERT INTO users (username, psw, firstname, lastname, phone, email, zip, city, exttype, imagetmp, user_id) VALUES (:newusername, :hashed_password, :fname, :lname, :phone, :email, :zip, :city, :exttype, :imagetmp, :user_id);";
				
					$stmt = $this->conn->prepare($sql);

					//bindParam for sql injection defence
					$stmt->bindParam(":newusername", $newusername);
					$stmt->bindParam(":hashed_password", $hashed_password);
					$stmt->bindParam(":fname", $fname);
					$stmt->bindParam(":lname", $lname);
					$stmt->bindParam(":phone", $phone);
					$stmt->bindParam(":email", $email);
					$stmt->bindParam(":zip", $zip);
					$stmt->bindParam(":city", $city);
					$stmt->bindParam(":exttype", $exttype);
					$stmt->bindParam(":user_id", $user_id);
					$stmt->bindParam(":imagetmp", $imagetmp, PDO::PARAM_LOB);
			
					$stmt->execute();
			
				}
			}
		}
	}

	public function checkUserID($user, $user_id) {
		$sql = "Select user_id From users WHERE username = :user";
		$stmt = $this->conn->prepare($sql);

		$stmt->bindParam(":user", $user);

		$stmt->execute();

		$user_id_db = $stmt->fetch();

		if($user_id_db[0] == $user_id){ 
			return true;
		} else {
			return false;
		}
	}
}



?>