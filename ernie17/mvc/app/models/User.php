<?php
class User extends Database {

	public function login($username, $password) {
		$users = $this->getUsers();

		if(isset($username) && isset($password)) {
			$inputUsername = filter_input(INPUT_POST, "login-username", FILTER_SANITIZE_STRING);
			$inputPassword = filter_input(INPUT_POST, "login-password", FILTER_SANITIZE_STRING);

			foreach ($users as $value) {
				#print_r("<br>username: " . $value["username"] . " password: " . $value["pass"]);
				if ($username === $value["username"] && password_verify($password, $value["pass"])) {
					$_SESSION["username"] = $username;
					$_SESSION['logged_in'] = true;
					header('location: /ernie17/mvc/public/pictures');
					return;
				}
			}

			$_SESSION['logged_in'] = false;
			$_SESSION["loginResult"] = "Wrong username og password!";

			header('Location: /ernie17/mvc/public/home');
		}

	}

	public function register ($username, $password, $passwordRepeat, $firstname, $lastname, $zip, $city, $email, $phone) {
		$users = $this->getUsers();

		if(isset($_POST["register-username"])) {

			foreach ($users as $value) {
				if ($username === $value["username"]) {
					$_SESSION["registerResult"] = "Username allready taken!";
					break;
				}
			}


			if (!isset($_SESSION["registerResult"]) && $password !== $passwordRepeat) {
				$_SESSION["registerResult"] = "Passwords doesn't match!";
			}


			// If input => create new user
			if (!isset($_SESSION["registerResult"])) {
				if ($username !== "" && $password !== "" && $firstname !== ""
				 && $lastname !== "" && $zip !== "" && $city !== ""
				  && $email !== "" && $phone !== "") {

			  		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

					$stmtAddUser = $this->conn->prepare("INSERT INTO picture_user (username, pass, firstname, lastname, zip, city, email, phone) VALUES (:username, :pass, :firstname, :lastname, :zip, :city, :email, :phone)");
					$stmtAddUser->bindparam(':username', $username);
					$stmtAddUser->bindparam(':pass', $hashedPassword);
					$stmtAddUser->bindparam(':firstname', $firstname);
					$stmtAddUser->bindparam(':lastname', $lastname);
					$stmtAddUser->bindparam(':zip', $zip);
					$stmtAddUser->bindparam(':city', $city);
					$stmtAddUser->bindparam(':email', $email);
					$stmtAddUser->bindparam(':phone', $phone);

					$stmtAddUser->execute();
				}
			}
		}

		header('location: /ernie17/mvc/public/home');
	}

	public function getUserInfo () {
		$stmtGetUsers = $this->conn->prepare("SELECT picture_user_id, username, firstname, lastname FROM picture_user");

		$stmtGetUsers->execute();
		$stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
		$resultGetUsers = $stmtGetUsers->fetchAll();

		$userInfo = [];

		foreach ($resultGetUsers as $value) {
			if ($_SESSION['username'] === $value["username"]) {
				$userInfo['userId'] = $value['picture_user_id'];
				$userInfo['firstname'] = $value["firstname"] . " ";
				$userInfo['lastname'] = $value["lastname"];
				break;
			}
		}

		return $userInfo;
	}

	public function getAllUsersInfo () {
		$stmtGetUsers = $this->conn->prepare("SELECT picture_user_id, username, firstname, lastname FROM picture_user");

		$stmtGetUsers->execute();
		$stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
		$resultGetUsers = $stmtGetUsers->fetchAll();

		return $resultGetUsers;
	}

	public function getUsersByRequest ($request) {
		$stmtGetUsers = $this->conn->prepare("SELECT picture_user_id, username, firstname, lastname FROM picture_user WHERE firstname LIKE :request");
        $stmtGetUsers->bindparam(':request', $request);

        $stmtGetUsers->execute();
        $stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
        $resultGetUsers = $stmtGetUsers->fetchAll();

		return $resultGetUsers;
	}

	public function getAllUsernameAndId () {
		$stmtGetUsers = $this->conn->prepare("SELECT picture_user_id as user_id, username FROM picture_user");

		$stmtGetUsers->execute();
		$stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
		$resultGetUsers = $stmtGetUsers->fetchAll();

		return $resultGetUsers;
	}

	public function validateUser ($username, $password) {
		$stmtGetUsers = $this->conn->prepare("SELECT picture_user_id, pass FROM picture_user WHERE username = :username");
		$stmtGetUsers->bindparam(':username', $username);

		$stmtGetUsers->execute();
		$stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
		$resultGetUsers = $stmtGetUsers->fetchAll();

		if (password_verify($password, $resultGetUsers[0]['pass'])) {
			return $resultGetUsers[0]['picture_user_id'];
		} else {
			return -1;
		}

	}

	private function getUsers () {
		$stmtGetUsers = $this->conn->prepare("SELECT username, pass FROM picture_user");

		$stmtGetUsers->execute();
		$stmtGetUsers->setFetchMode(PDO::FETCH_ASSOC);
		$resultGetUsers = $stmtGetUsers->fetchAll();

		return $resultGetUsers;
	}

}
