<?php

class Picture extends Database {

	public function getAllPictures() {
		$getPictureStmt = $this->conn->prepare("SELECT person, title, description, picture_file FROM picture ORDER BY date_uploaded DESC LIMIT 20");

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

	    //$hashedPicFile = hash("sha1", $file_name).$dotString.$file_ext;

	    $extensions= array("jpeg","jpg","png");

	    if(in_array($file_ext, $extensions) === false) {
	      $erros[]="extensions not allowed";
	    }

	    if ($file_size > 20000000) {
	      $errors[]="file too big";
	    }

	    if(empty($errors)==true){
	      ///move_uploaded_file($file_tmp, "pictures/".$file_name);
	     // move_uploaded_file($file_tmp, "pictures/".$hashedPicFile);

	      $userInput = $_SESSION['userNameGlobal'];
				$file = file_get_contents($file_tmp);
				//$base64 = 'data:image/' . $file_type . ';base64' . base64_encode($file);
				$base64 = "data:image;base64," . base64_encode($file);
				//print_r($base64);

	      $insertPictureStmt->bindparam(':person', $userInput);
	      $insertPictureStmt->bindparam(':title', $pictureTitleInput);
	      $insertPictureStmt->bindparam(':description', $pictureDescInput);
	      $insertPictureStmt->bindparam(':picture_file', $base64);
	      $didExecute = $insertPictureStmt->execute();
	    } else {
	      print_r($errors);
	    }
	  }
    header('Location: /anott17/mvc/public/upload');
	}
    header('Location: /absay12/mvc/public/upload');
	}
}
