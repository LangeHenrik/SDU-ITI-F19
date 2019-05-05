<?php
class Picture extends Database {
	
	public function getAllPictures(){
		$sql = "SELECT * FROM pictures";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$pictures = $stmt->fetchAll();

		return $pictures;
	}
	
	public function getUserPictures($userId){
		$sql = "SELECT * FROM pictures WHERE user_id = :user_id";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam('user_id', $userId);
		$stmt->execute;
		$pictures = $stmt->fetchAll();

		return $pictures;
	}
	
	public function postPicture($title, $description, $image){
		$sql = "INSERT INTO pictures (title, description, image, user_id) VALUES(:title, :description, :image, :user_id)";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam('title', $title);
		$stmt->bindParam('description', $description);
		$stmt->bindParam('image', $image);
		$stmt->bindParam('user_id', $_SESSION['user_id']);
		
		$stmt->execute();
		$user_id = $this->conn->lastInsertId();
		
		return $user_id;
	}

}