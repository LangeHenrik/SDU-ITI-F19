<?php
class Image extends Database {
	
	public $id;
	public $title;
	public $description;
	public $uploadedBy;

	
	public function listAllImages() {
		
		
		$images = array();
        $stmt = $this->conn->prepare("SELECT image_id,title,description,image,user.username FROM image LEFT JOIN user ON uploadedby = user.user_id");

        $results = array();
        if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }
		}	
        foreach($results as $result) {
            $tempImage = new Image();
            $tempImage->id = $result['image_id'];
            $tempImage->title = $result['title'];
            $tempImage->description = $result['description'];
            $tempImage->uploadedby = $result['username'];
            $tempImage->image = $result['image'];
            array_push($images, $tempImage);
        }
		$conn = null;
		return $images;
	}
	
	public function APIUploadImage($image, $imageTitle, $imageDesciption, $userID) {
    $userName = (new User)->getUserName($userID);

		$insertPictureStmt = $this->conn->prepare("INSERT INTO image(title, description, uploadedby, image)
                                    VALUES(:title, :description, :uploadedBy, :image)");


    $insertPictureStmt->bindparam(':title', $imageTitle);
    $insertPictureStmt->bindparam(':description', $imageDesciption);
    $insertPictureStmt->bindparam(':uploadedBy', $userID);
    $insertPictureStmt->bindparam(':image', $image);
    $insertPictureStmt->execute();

		
		$conn = null;
		return $userID;
	}
	
	public function getPicturesFromUser($userid) {
		$stmt = $this->conn->prepare("SELECT image ,title,description FROM image WHERE uploadedby = :id");
        $stmt->bindParam(':id', $userid);
        $results = array();
        if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }
        }
        return $results;
    }
		/*
		$sqlStmt = $this->conn->prepare("SELECT image, title, description FROM image WHERE uploadedby = :userid");
		$sqlStmt->bindparam(':userid', $userid);
		/*$sqlStmt->execute();
		$sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sqlStmt->fetchAll();
		return $result;
		$result = array();
        if ($sqlStmt->execute()) {
        while ($row = $sqlStmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        }
        return $result;
		*/
	
	
	 /*$result = array();
        if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        }
        return $result;*/
	
	public function listImagesFromUser($userID) {
		
		
		$getImages = $this->conn->prepare("SELECT * FROM image WHERE uploadedby=:user");
		$getImages->bindParam(':user', $userID);
		$getImages->execute();
		$getImages->setFetchMode(PDO::FETCH_ASSOC);
		$tempImages = $getImages->fetchAll();
		
		$conn = null;
		return $tempImages;
	}
	
	public function uploadImage($userID) {
		$image = file_get_contents($_FILES["imageuploader"]["tmp_name"]);
		$postImage = $this->conn->prepare("INSERT INTO image (title, description, uploadedby, image) VALUES (:title, :description, :uploadedby, :image);");
			$postImage->bindParam(':title', $_POST['title']);
			$postImage->bindParam(':description', $_POST['description']);
			$postImage->bindParam(':uploadedby', $_SESSION['user_id']);
			$postImage->bindParam(':image', $image, PDO::PARAM_LOB);
			//$picture = base64_encode($image);
			$postImage->execute();
			
			$conn = null;
	}

}