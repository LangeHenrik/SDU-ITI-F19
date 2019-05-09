<?php
class Picture extends Database {
	
	public function getAllPictures(){
		$sql = "SELECT * FROM images";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$pictures = $stmt->fetchAll();

		return $pictures;
	}

	public function getPersonalImagesByName($input){
		
	$personalUsername = $input;
	$stmt = $conn->prepare('select * from images WHERE username = :username');
	
	$stmt->bindParam(':username', $personalUsername);

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $result = $stmt->fetchAll();
	
	return $result;
		
	}
	/*private function getUsernameFromID ($userId){
		
		
		
		$sql = "SELECT username FROM users WHERE id = :user_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user_id', $userId);
		//$stmt->bindParam(':user_id', $SESSION['id']);
		$stmt->execute();
		$stmt->setFetchMode();
		$result = $stmt->fetchAll();
		$username = $result[0]['username'];
		
		return  $username;
	}*/
	
	private function getUsernameFromID($userId){
		
		
	
	$sqlStmt = $this->conn->prepare("SELECT username FROM users WHERE id = :userId");
	$sqlStmt->bindParam(':userId', $userId);
	//echo json_encode("this is the userID:" . $userId);
	
	$sqlStmt->execute();
	$sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
	// $username = $sqlStmt->fetchAll();
	$result = $sqlStmt->fetchAll();
	$username = $result[0]['username'];
	
	return $username;
	
	}
	
	/*public function getUserPictures($userId) {
		
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
	/*

		$username = $this->getUsernameFromID($userId);
		// $usernames = $username[0];
		
		$stmtPictures = $this->conn->prepare("SELECT image_id, title, description, image FROM images WHERE username = :username");
		$stmtPictures->bindParam(':username', $username);
		
		$stmtPictures->execute();
		$stmtPictures->setFetchMode(PDO::FETCH_ASSOC);
		$resultPictures = $stmtPictures->fetchAll();
		
		return $resultPictures;
		
		
		
	
		
		//return $pictures;
	}*/
	
	/*public function getIdFromUsername($username){
		
		$sql = "SELECT id FROM users WHERE username = :username order by image_id desc";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		
		$stmt->execute();
		
		$userId = $stmt->fetchAll();
		
		return $userId;
		
	}*/
	
	public function postPicture ($title, $description, $image) {
		
		$userId = $_SESSION['id'];
		
				$sql = "SELECT username FROM users WHERE id = :user_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user_id', $userId);
		//$stmt->bindParam(':user_id', $SESSION['id']);
		$stmt->execute();
		$stmt->setFetchMode();
		$result = $stmt->fetchAll();
		$username = $result[0]['username'];
		
		//$username = $this->getUsernameFromID($_SESSION['id']);

		
		$sql = "INSERT INTO images(username, image, title, description) VALUES(:username, :image, :title, :description)";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':image', $image);
		
		
		$stmt->execute();
		$userId = $this->conn->lastInsertId();
		
		return $userId;
		
	}
	
	public function uploadPicture($inputTitle, $inputDescription, $isPicUploaded) {
		
		$stmt = $this->conn->prepare("INSERT INTO images(username, image, title, description) 
									VALUES(:username, :image, :title, :description)");
		
		if (isset($isPicUploaded)) {
			
			$errors = array();
			
			$file_name = $_FILES['fileToUpload']['name'];
			$file_size = $_FILES['fileToUpload']['size'];
			$file_tmp = $_FILES['fileToUpload']['tmp_name'];
			$file_type = $_FILES['fileToUpload']['type'];
			$tmp = explode('.',$_FILES['fileToUpload']['name']);
			$file_ext=strtolower(end($tmp));
			
			$dotString = '.';
			
			$extensions = array("jpeg","jpg","png");
			
			if(in_array($file_ext, $extensions) === false) {
			$erros[]="extensions not allowed";
			}
			if ($file_size > 20000000) {
			  $errors[]="file too big";
				}
			if(empty($errors)==true){
		 
			  $userInput = $_SESSION['username'];
				$file = file_get_contents($file_tmp);
				$base64 = "data:image;base64," . base64_encode($file);
					
			  $stmt->bindparam(':username', $userInput);
			  $stmt->bindparam(':title', $inputTitle);
			  $stmt->bindparam(':description', $inputDescription);
			  $stmt->bindparam(':image', $base64);
			  $didExecute = $stmt->execute();
			} else {
			  print_r($errors);
			}
		header('Location: /nifra17/mvc/public/upload');
	    }
    
	}
		
		
		
}
	




