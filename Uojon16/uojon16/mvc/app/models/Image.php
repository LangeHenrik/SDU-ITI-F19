<?php
class Image extends Database {
	
	public $id;
	public $title;
	public $description;
	public $uplodedBy;

	
	public function listAllImages() {
		
		
		$getImages = $this->conn->prepare("SELECT * FROM image");
		
		$getImages->execute();
		$getImages->setFetchMode(PDO::FETCH_ASSOC);
		$tempImages = $getImages->fetchAll();
		
		$conn = null;
		return $tempImages;
	}
	
	public function listImagesFromUser($userID) {
		
		
		$getImages = $this->conn->prepare("SELECT * FROM image WHERE uploadedby=:user");
		$getImages->bindParam(':user', $userID);
		$getImages->execute();
		$getImages->setFetchMode(PDO::FETCH_ASSOC);
		$tempImages = $getImages->fetchAll();
		
		$conn = null;
		return $tempImages;
	}
	
	public function uploadImage() {
		$postImage = $this->conn->prepare("INSERT INTO image ( title, description, uplodedby, image) VALUES (:title, :description, :uploadedby, :image);");
			$image = file_get_contents($_FILES["image"]["tmp_name"]);
			$postImage->bindParam(':title', $_POST['title']);
			$postImage->bindParam(':description', $_POST['description']);
			$postImage->bindParam(':uploadedby',$_SESSION['user_id']);
		
			$postImage->bindParam(':image', $image, PDO::PARAM_LOB);
			$postImage->execute();
			
			$conn = null;
	}

}