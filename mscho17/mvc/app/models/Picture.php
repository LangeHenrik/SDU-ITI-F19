<?php
class Picture extends Database {
	
	public function getPictures($offset = 0){
		
		$stmt = $this->conn->prepare("SELECT * FROM post LIMIT 20 offset $offset");
		$stmt -> execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	
	public function postPicture($user_id, $image, $title, $description){
		
		$pictureTitle = htmlentities(filter_var($title, FILTER_SANITIZE_STRING));
		$picture = htmlentities(filter_var($image, FILTER_SANITIZE_STRING));
		$pictureDescription = htmlentities(filter_var($description, FILTER_SANITIZE_STRING));
		
		$stmt = $this->conn->prepare("INSERT INTO post (user_id, title, post_header, description, image) 
							VALUES (:post_user_id, :pictureTitle, :post_header, :post_description, :image)");
		$nothing = "nothing";
		$stmt->bindParam(':post_user_id', $user_id);
		$stmt->bindParam(':pictureTitle', $pictureTitle);
		$stmt->bindParam(':post_header', $nothing);
		$stmt->bindParam(':post_description', $pictureDescription);
		$stmt->bindParam(':image', $picture);
		$stmt->execute();
		
		$stmt = $this->conn->prepare("SELECT image_id FROM post where image = '$picture'");
		$stmt->execute();
		$result = $stmt->fetchAll();
		$image_id = $result;
		return $image_id;
	}
	
	
	public function getUserPictures($user_id){
		
		$stmt = $this->conn->prepare("SELECT * FROM post where user_id = $user_id");
		$stmt -> execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	

}