<?php
class User extends Database {

	// public $name;

	public function login($username, $password) {
			$getPasswordStmt = $this->conn->prepare("SELECT user_name AS userNameDB, password AS passwordDB FROM person WHERE user_name = :user_name");

			if(isset($username) && isset($password)) {
		    $getPasswordStmt->bindparam(':user_name', $username);

		    $getPasswordStmt->execute();
		    $getPasswordStmt->setFetchMode(PDO::FETCH_ASSOC);
		    $result = $getPasswordStmt->fetchAll();

		    $tmpArray = current($result);

		    if(!empty($tmpArray)) {
		      $tmpUserName = $tmpArray['userNameDB'];
		      $tmpPassword = $tmpArray['passwordDB'];

		      if ($username == $tmpUserName && password_verify($password, $tmpPassword)){
		          $_SESSION['userNameGlobal'] =  $_POST["userNameLogin"];
		          $_SESSION['logged_in'] = true;
		          header('Location: /soben14/mvc/public/pictures');
		      } else {
		        $_SESSION['globalLoginMsg'] = "Wrong password, username or both.";
						header('Location: /soben14/mvc/public/home');
		      }
		    }
		    else {
		      $_SESSION['globalLoginMsg'] = " EMPTY: Wrong password, username or both.";
					header('Location: /soben14/mvc/public/home');
		    }
		 }
	}

	public function register($userNameInput, $passwordInput, $firstNameInput, $lastNameInput, $zipInput, $cityInput, $phoneNumberInput, $emailAdressInput) {
		$getUserNameStmt = $this->conn->prepare("SELECT 1 from person WHERE user_name = :user_name");
    $registerStmt = $this->conn->prepare("INSERT INTO person (user_name, password, first_name, last_name, zip_code, city, phone_number, email_adress)
                            VALUES(:user_name, :password, :first_name, :last_name, :zip_code, :city, :phone_number, :email_adress)");

		if (isset($userNameInput)) {
	    $hashedPassword = password_hash($passwordInput, PASSWORD_DEFAULT);

	    $getUserNameStmt->bindparam(':user_name', $userNameInput);

	    $getUserNameStmt->execute();
	    $getUserNameStmt->setFetchMode(PDO::FETCH_ASSOC);
	    $result = $getUserNameStmt->fetchAll();

	    if (count($result) == 1) {
	      $_SESSION['globalRegisterMsg'] = "Username is already taken.";
	    }
	    else {
	      $registerStmt->bindparam(':user_name', $userNameInput);
	      $registerStmt->bindparam(':password', $hashedPassword);
	      $registerStmt->bindparam(':last_name', $lastNameInput);
	      $registerStmt->bindparam(':first_name', $firstNameInput);
	      $registerStmt->bindparam(':zip_code', $zipInput);
	      $registerStmt->bindparam(':city', $cityInput);
	      $registerStmt->bindparam(':phone_number', $phoneNumberInput);
	      $registerStmt->bindparam(':email_adress', $emailAdressInput);
	      $registerStmt->execute();
	      $_SESSION['globalRegisterMsg'] = "Account created, you can now login.";
	    }
	  }
		header('Location: /soben14/mvc/public/home');
	}

	public function getUsers() {
		$getUsersStmt = $this->conn->prepare("SELECT user_id,user_name, first_name, last_name, email_adress FROM person ORDER BY user_id ");

		$getUsersStmt->execute();
	  $getUsersStmt->setFetchMode(PDO::FETCH_ASSOC);
	  $result = $getUsersStmt->fetchAll();

		return $result;
	}

	public function getUserNamesAndIDs() {
		$sqlStmt = $this->conn->prepare("SELECT user_name as username, user_id as user_id FROM person");

		$sqlStmt->execute();
		$sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sqlStmt->fetchAll();

		return $result;
	}

	public function validateUsers($username, $password) {
		$sqlStmt = $this->conn->prepare("SELECT user_id, password FROM person WHERE user_name = :username");
		$sqlStmt->bindparam(':username', $username);
		$sqlStmt->execute();
		$sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sqlStmt->fetchAll();
		if (password_verify($password, $result[0]['password'])) {
			return $result[0]['user_id'];
		} else {
			return 'error';
		}
	}
}
