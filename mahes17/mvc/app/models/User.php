<?php
class User extends Database
{

	public function login($username, $password)
	{
		$sql = "SELECT username, password FROM users WHERE username = :username;";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$users = $stmt->fetchAll();

		if (isset($users[0]) && sizeof($users) == 1 && $users[0]['username'] == $username) {
			if (password_verify($password, $users[0]['password'])) {
				$_SESSION['logged_in'] = true;
				$_SESSION['user'] = $username;
				header('Location: /mikkp17/mvc/public/login');
			}
		}
		return false;
	}

	public function logout()
	{
		session_unset();
		session_destroy();
		header('Location: /mikkp17/mvc/public/home');
	}

	public function getAllUsers()
	{
		$sql = "SELECT username, firstn, lastn, zip, city, email, phonenumber FROM users";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$users = $stmt->fetchAll();
		return $users;
	}

	public function checkUsername($username)
	{
		$sql = "SELECT user_id FROM users WHERE username = :username;";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$username = $stmt->fetchAll();

		if (isset($username[0])) {
			return false;
		} else {
			return true;
		}
	}

	public function checkEmail($email)
	{
		$sql = "SELECT user_id FROM users WHERE email = :email;";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$username = $stmt->fetchAll();

		if (isset($username[0])) {
			return false;
		} else {
			return true;
		}
	}

	public function signUp($username, $hashed_password, $firstn, $lastn, $zip, $city, $email, $phonenumber)
	{
		$sql = "INSERT INTO users (username, password, firstn, lastn, zip, city, email, phonenumber) VALUES (:username, :password, :firstn, :lastn, :zip, :city, :email, :phonenumber);";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":username", $username);
		$stmt->bindParam(":password", $hashed_password);
		$stmt->bindParam(":firstn", $firstn);
		$stmt->bindParam(":lastn", $lastn);
		$stmt->bindParam(":zip", $zip);
		$stmt->bindParam(":city", $city);
		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":phonenumber", $phonenumber);
		$stmt->execute();

		$_SESSION['logged_in'] = true;
		$_SESSION['user'] = $username;
		header('Location: /mikkp17/mvc/public/login');
	}

	public function ajax($request)
	{
		$sql = "SELECT username FROM users WHERE username LIKE :hint";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':hint', $request);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function validateUserId($username, $password)
	{
		$sql = "SELECT user_id, password FROM users WHERE username = :username";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if (password_verify($password, $result[0]['password'])) {
			return $result[0]['user_id'];
		} else {
			return "-1";
		}
	}

	public function getUsersAPI()
	{
		$sql = "SELECT user_id, username FROM users ORDER BY user_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}
