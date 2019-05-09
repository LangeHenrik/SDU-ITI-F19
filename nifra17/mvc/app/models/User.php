<?php
class User extends Database {
	

	public function login($username, $password){

		$sql = "SELECT id, username, password FROM users WHERE username = :username";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$users = $stmt->fetchAll();
		
		if(isset($users[0]) && sizeof($users) == 1 && $users[0]['username'] == $username) {
			
			if($users[0]['password'] == $password) {
				$_SESSION['logged_in'] = true;
				$_SESSION['username'] = $_POST["username"];
				$_SESSION['id'] = $users[0]['id'];
				header('Location: /nifra17/mvc/public/pictures');
				return true;
			}
			else {
				
				header ('Location: /nifra17/mvc/public/home');
			}	

		}
		header ('Location: /nifra17/mvc/public/home');
		return false;
	}
	
	public function register($inputUsername, $inputPassword){
		
		$stmtGetUsername = $this->conn->prepare("SELECT 1 FROM users WHERE username = :username");
		$stmtRegister = $this->conn->prepare("INSERT INTO users (username, password)
											VALUES (:username, :password)");
											
		if(isset($inputUsername)){
			
			$stmtGetUsername->bindParam(':username', $inputUsername);
			$stmtGetUsername->execute();
			$stmtGetUsername->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stmtGetUsername->fetchAll();
			
			if(count($result) == 1){
				
			}
			else{
				$stmtRegister->bindParam(':username', $inputUsername);
				$stmtRegister->bindParam(':password', $inputPassword);
				$stmtRegister->execute();
				
			}
		}
		header('Location: /nifra17/mvc/public/home');
	}
	
		public function getUserPictures($request) {
			
	//		header('Location: /nifra17/mvc/public/getusers');
		
		/*$_SESSION['id'] = $users[0]['id'];
		echo $_SESSION['id'];
		$sql = "SELECT username FROM users WHERE id = :user_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user_id', $userId);
		//$stmt->bindParam(':user_id', $SESSION['id']);
		$stmt->execute();
		$stmt->setFetchMode();
		$result = $stmt->fetchAll();
		$username = $result;
		
		
		echo json_encode($username);
		//$username = getUsernameFromID($userId);
		
		//$username = $this->getUsernameFromID($_SESSION['id']);
		
		$sql = "SELECT image_id, title, description, image FROM images WHERE username = :username order by image_id desc";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username', $username[0]['username']);
		$stmt->execute();
		$stmt->setFetchMode();
		$pictures = $stmt->fetchAll();*/
	

		//$username = $this->getUsernameFromID($userId);
		// $usernames = $username[0];
		
		
		$stmtPictures = $this->conn->prepare("SELECT title, username, image, description FROM images WHERE username = :username");
		$stmtPictures->bindParam(':username', $request);
		
		$stmtPictures->execute();
		$stmtPictures->setFetchMode(PDO::FETCH_ASSOC);
		$resultPictures = $stmtPictures->fetchAll();
		
		return $resultPictures;
		/*
		foreach ($resultPictures as $value) {
			$userPicture['username'] = $value['username'];
			$userPicture['title'] = $value['title'];
			$userPicture['image'] = $value['image'];
			$userPicture['description'] = $value['description'];
			
			break;
			
		}*/
		
		
		

	}
	
	

	public function getAllUsers(){
		
		$sql = "SELECT id as user_id, username FROM users";
		$stmt = $this->conn->prepare($sql);
		
		$stmt->execute();
		$users = $stmt->fetchAll();
		
		return $users;
	}
}

