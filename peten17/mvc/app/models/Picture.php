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
		$sql = $this->conn->prepare("INSERT INTO peten17.picture (username, image_title, image_desc, image_file) VALUES(:username, :imageTitle, :imageDesc, :imageFile);");

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
				//print_r($base64Image);
				print_r($username);
				//print_r($base64Image);
				print_r($pictureTitle);
				print_r($imageDesc);
				print_r($_FILES);





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

	public function pictureByUser($id){
		$username = $this->model('User')->getUserById($id);
		$sql = $this->conn->prepare("SELECT image_id, image_title, image_desc, image_file FROM picture WHERE username =:username;");
		$sql->bindParam(':username',$username);
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$users = $sql->fetchAll();
		return $users;
	}


	public function apiUploadPicture($image,$imageTitle,$imageDesc,$userid){
		$username = $this->model('User')->getUserNameFromID($userid);

		$sql = $this->conn->prepare("INSERT INTO peten17.picture (username, image_title, image_desc, image_file) VALUES(:username, :imageTitle, :imageDesc, :imageFile);");

		$sql->bindparam(':username', $username);
		$sql->bindparam(':imageTitle', $imageTitle);
		$sql->bindparam(':imageDesc', $imageDesc);
		$sql->bindparam(':imageFile', $image);
		$sql->execute();

		$lastInsertID = $this->conn->lastInsertId();
		return $lastInsertID;

	}

}