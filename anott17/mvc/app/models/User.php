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
		          header('Location: /anott17/mvc/public/pictures');
		      } else {
		        $_SESSION['globalLoginMsg'] = "Wrong password, username or both.";
						header('Location: /anott17/mvc/public/home');
		      }
		    }
		    else {
		      $_SESSION['globalLoginMsg'] = " EMPTY: Wrong password, username or both.";
					header('Location: /anott17/mvc/public/home');
		    }
		 }
	}

	public function register($userNameInput, $passwordInput, $frontNameInput, $lastNameInput, $zipInput, $cityInput, $phoneNumberInput, $emailAdressInput) {
		$getUserNameStmt = $this->conn->prepare("SELECT 1 from person WHERE user_name = :user_name");
    $registerStmt = $this->conn->prepare("INSERT INTO person (user_name, password, front_name, last_name, zip_code, city, phone_number, email_adress)
                            VALUES(:user_name, :password, :front_name, :last_name, :zip_code, :city, :phone_number, :email_adress)");

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
	      $registerStmt->bindparam(':front_name', $frontNameInput);
	      $registerStmt->bindparam(':zip_code', $zipInput);
	      $registerStmt->bindparam(':city', $cityInput);
	      $registerStmt->bindparam(':phone_number', $phoneNumberInput);
	      $registerStmt->bindparam(':email_adress', $emailAdressInput);
	      $registerStmt->execute();
	      $_SESSION['globalRegisterMsg'] = "Account created, you can now login.";
	    }
	  }
		header('Location: /anott17/mvc/public/home');
	}

	public function getUsers() {
		$getUsersStmt = $this->conn->prepare("SELECT user_name, front_name, last_name FROM person");

		$getUsersStmt->execute();
	  $getUsersStmt->setFetchMode(PDO::FETCH_ASSOC);
	  $result = $getUsersStmt->fetchAll();

		return $result;
	}

	public function getUserNamesAjax($request) {

		$sqlStmt = $this->conn->prepare("SELECT user_name, front_name, last_name, city, zip_code, email_adress FROM person WHERE user_name LIKE :tmp");
		$sqlStmt->bindparam(':tmp', $request);

		$sqlStmt->execute();
		$sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sqlStmt->fetchAll();

		return $result;
	}

	public function getUserNamesAndIDs() {
		$sqlStmt = $this->conn->prepare("SELECT user_name as username, person_id as user_id FROM person");

		$sqlStmt->execute();
		$sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sqlStmt->fetchAll();

		return $result;
	}

	public function validateUsers($username, $password) {
		$sqlStmt = $this->conn->prepare("SELECT person_id, password FROM person WHERE user_name = :username");
		$sqlStmt->bindparam(':username', $username);
		$sqlStmt->execute();
		$sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sqlStmt->fetchAll();
		if (password_verify($password, $result[0]['password'])) {
			return $result[0]['person_id'];
		} else {
			return 'error';
		}
	}
}
