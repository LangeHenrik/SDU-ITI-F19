<?php

class Picture extends Database {

	public function getAllPictures() {
		$sql = "SELECT * FROM picture";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$pictures = $stmt->fetchAll();

		return $pictures;
	}

	public function upload ($header, $description, $isFileChosen, $userId) {
		if ($isFileChosen) {
			$respons = "";
			$fileName = $_FILES['image-upload']['name'];
			$fileSize = $_FILES['image-upload']['size'];
			$fileTmp = $_FILES['image-upload']['tmp_name'];
			$fileType = $_FILES['image-upload']['type'];

			$fileNameExploded = explode ('.', $_FILES['image-upload']['name']);
			$fileExt = strtolower(end($fileNameExploded));

			$validExtensions = array("jpeg", "jpg", "png");

			if (in_array($fileExt, $validExtensions) === false) {
				$respons = $respons . "Invalid extension! Only .jpeg, .jpg and .png files allowed<br>";
			}

			if ($fileSize > 5000000) {
				$respons = $respons . "The file is too large! (must be less than 5 MB) <br>";
			}

			if ($respons === "") {
				#$uploadFileName = time() . "-" . $fileName;
				# Upload file
				#move_uploaded_file($fileTmp, "uploads/" . $uploadFileName);

				# create base64
				$file = file_get_contents($fileTmp);
			    //$base64 = 'data:image/' . $fileType . ';base64,' . base64_encode($file);
				$base64 = "data:image;base64," . base64_encode($file);

			    #echo "Base64 is " . $base64;

				$stmtUploadImage = $this->conn->prepare("INSERT INTO picture (picture_user_id, image_name, header, description) VALUES (:userID, :imageName, :header, :description)");
				$stmtUploadImage->bindparam(':userID', $userId);
				$stmtUploadImage->bindparam(':imageName', $base64);
				$stmtUploadImage->bindparam(':header', $header);
				$stmtUploadImage->bindparam(':description', $description);

				$stmtUploadImage->execute();

				$respons =  "File uploaded!";
			}
		}
		header('Location: /ernie17/mvc/public/upload');
	}

	public function apiUpload ($image, $header, $description, $userId) {
		$stmtUploadImage = $this->conn->prepare("INSERT INTO picture (picture_user_id, image_name, header, description) VALUES (:userID, :imageName, :header, :description)");
		$stmtUploadImage->bindparam(':userID', $userId);
		$stmtUploadImage->bindparam(':imageName', $image);
		$stmtUploadImage->bindparam(':header', $header);
		$stmtUploadImage->bindparam(':description', $description);

		$stmtUploadImage->execute();

		$id = $this->conn->lastInsertId();
		return $id;
	}

	public function getPicturesFromUser ($userId) {
		// $stmtGetPictures = $this->conn->prepare("SELECT picture_id as image_id, image_name as image, header as title, description FROM picture WHERE picture_user_id = :userId");
		$stmtGetPictures = $this->conn->prepare("SELECT picture_id as image_id, header as title, description, image_name as image FROM picture WHERE picture_user_id = :userId");
		$stmtGetPictures->bindparam(':userId', $userId);

		$stmtGetPictures->execute();
		$stmtGetPictures->setFetchMode(PDO::FETCH_ASSOC);
		$resultGetPictures = $stmtGetPictures->fetchAll();

		return $resultGetPictures;
	}

}
