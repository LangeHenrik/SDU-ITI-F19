<?php

class Picture extends Database {

	public function getAllPictures() {
		$getPictureStmt = $this->conn->prepare("SELECT person, title, description, picture_file FROM picture ORDER BY date_uploaded DESC");

		$queryExecuted = $getPictureStmt->execute();
		$getPictureStmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $getPictureStmt->fetchAll();

		return $result;
	}

	public function uploadPicture($pictureTitleInput, $pictureDescInput, $isPicUploaded) {
		$insertPictureStmt = $this->conn->prepare("INSERT INTO picture(person, title, description, picture_file, date_uploaded)
                                      VALUES(:person, :title, :description, :picture_file, now())");

		if (isset($isPicUploaded)) {

	    $errors = array();

	    $file_name = $_FILES['image']['name'];
	    $file_size = $_FILES['image']['size'];
	    $file_tmp = $_FILES['image']['tmp_name'];
	    $file_type = $_FILES['image']['type'];
	    $tmp = explode('.',$_FILES['image']['name']);
	    $file_ext=strtolower(end($tmp));

	    $dotString = '.';

	    $extensions= array("jpeg","jpg","png");

	    if(in_array($file_ext, $extensions) === false) {
	      $erros[]="extensions not allowed";
	    }

	    if ($file_size > 20000000) {
	      $errors[]="file too big";
	    }

	    if(empty($errors)==true){

	      $userInput = $_SESSION['userNameGlobal'];
				$file = file_get_contents($file_tmp);
				$base64 = "data:image;base64," . base64_encode($file);

	      $insertPictureStmt->bindparam(':person', $userInput);
	      $insertPictureStmt->bindparam(':title', $pictureTitleInput);
	      $insertPictureStmt->bindparam(':description', $pictureDescInput);
	      $insertPictureStmt->bindparam(':picture_file', $base64);
	      $didExecute = $insertPictureStmt->execute();
	    } else {
	      print_r($errors);
	    }
	  }
    header('Location: /soben14/mvc/public/upload');
	}

	public function APIUploadPicture($image, $pictureTitleInput, $pictureDescInput, $userID) {
    $userName = $this->getUserNameFromID($userID);

		$insertPictureStmt = $this->conn->prepare("INSERT INTO picture(person, title, description, picture_file, date_uploaded)
                                    VALUES(:person, :title, :description, :picture_file, now())");


    $insertPictureStmt->bindparam(':person', $userName);
    $insertPictureStmt->bindparam(':title', $pictureTitleInput);
    $insertPictureStmt->bindparam(':description', $pictureDescInput);
    $insertPictureStmt->bindparam(':picture_file', $image);
    $insertPictureStmt->execute();

		$id = $this->conn->lastInsertId();
		return $id;
	}
	// den viser det lidt funky-wunky.
	public function getPicturesFromUser($userid) {
		$userName = $this->getUserNameFromID($userid);
		$sqlStmt = $this->conn->prepare("SELECT picture_id as image_id, title, description, picture_file as image FROM picture WHERE person = :username");
		$sqlStmt->bindparam(':username', $userName);
		$sqlStmt->execute();
		$sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sqlStmt->fetchAll();
		return $result;
	}
	
	private function getUserNameFromID($userid) {
		$sqlStmt = $this->conn->prepare("SELECT user_name FROM person WHERE user_id = :userid");
		$sqlStmt->bindparam(':userid', $userid);

		$sqlStmt->execute();
		$sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sqlStmt->fetchAll();
		$userName = $result[0]['user_name'];

		return $userName;
	}
}
