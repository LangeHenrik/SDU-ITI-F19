<?php
class Picture extends Database {
	
	public function getAllPictures(){
		$sql = "SELECT * FROM picture";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$pictures = $stmt->fetchAll();

		return $pictures;
	}

	public function uploadPicture($pictureTitle,$pictureDescription,$pictureLoaded){
		$sql = $this->conn->prepare("INSERT INTO peten17.picture (username, title, description, image) VALUES(:username, :imageTitle, :imageDesc, :imageFile);");

		$errors = array();

		if (isset($pictureLoaded)) {
			// The path to store the uploaded image
	  	  
			// Get all the sumbmitted data from the form
			$file = $_FILES['pictureFile'];
			$image = $_FILES['pictureFile']['name'];
			$fileTmpName = $_FILES['pictureFile']['tmp_name'];
			$fileSize = $_FILES['pictureFile']['size'];
			$fileError = $_FILES['pictureFile']['error'];
			$fileType = $_FILES['pictureFile']['type'];
			//$imageTitle = $pictureTitle;
			$imageDesc = $pictureDescription;

			// to get the filetype we need to explode the filename at '.'
			$tmp = explode('.',$_FILES['pictureFile']['name']);
			$fileExt=strtolower(end($tmp));

			$allowedExtensions = array("jpg","jpeg","png");
			print_r($_FILES);
			if(in_array($fileExt, $allowedExtensions) === false) {
				$erros[]="extension not allowed";
			}
			if ($fileSize > 20000000) {
				$errors[]="file too big";
			}

			if(empty($errors)==true){
				$username = $_SESSION['username'];
				$file = file_get_contents($fileTmpName);
					 
				$base64Image = "data:image;base64," . base64_encode($file);
			
				$sql->bindparam(':username', $username);
				$sql->bindparam(':imageTitle', $pictureTitle);
				$sql->bindparam(':imageDesc', $imageDesc);
				$sql->bindparam(':imageFile', $base64Image);
				print_r($sql);
				//$executeDone = 
				$sql->execute();
			  } else {
				print_r($errors);
			  }
			header('Location: /peten17/mvc/public/index');
		}			
	}

	public function getPicturesFromUser($id){
		$username = $this->getUserNameFromId($id);
		$sql = $this->conn->prepare("SELECT image_id, title, description, image FROM picture WHERE username =:username;");
		$sql->bindParam(':username',$username);
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sql->fetchAll();
		//print_r($result);
	
		return $result;
	}


	public function apiUploadPicture($image,$imageTitle,$imageDesc,$userid){
		$username = $this->getUserNameFromID($userid);

		//$sql = $this->conn->prepare("INSERT INTO peten17.picture (username, title, desc, image) VALUES(:username, :title, :desc, :image);");
		$sql = $this->conn->prepare("INSERT INTO peten17.picture (username, title, description, image) VALUES(:username, :imageTitle, :imageDesc, :imageFile);");

		$sql->bindparam(':username', $username);
		$sql->bindparam(':imageTitle', $imageTitle);
		$sql->bindparam(':imageDesc', $imageDesc);
		$sql->bindparam(':imageFile', $image);

		$sql->execute();

		$lastInsertID = $this->conn->lastInsertId();
		
		return $lastInsertID;

	}
	private function getUserNameFromID($id) {
		$sql = $this->conn->prepare("SELECT username FROM users WHERE user_id = :userid");
		$sql->bindparam(':userid', $id);
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sql->fetch();
		$username = $result['username'];
		return $username;
	}


}