<?php

class Post extends Database {
	
	public function getPosts($amount, $offset) {
		$query = $this->conn->prepare("SELECT * FROM post ORDER BY time_created DESC LIMIT $amount OFFSET $offset;");
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$posts = $query->fetchAll();
		
		return $posts;
	}
	
	public function uploadPost($header, $description, $image, $user_id) {
		$stmt = $this->conn->prepare("INSERT INTO post(header, description, picture, user_id) VALUES(:header, :description, :image, :user_id);");
		
		$stmt->bindParam(':header',$header);
		$stmt->bindParam(':description',$description);
		$stmt->bindParam(':image',$image);
		$stmt->bindParam(':user_id',$user_id);
		
		$stmt->execute();
		$post_id = $this->conn->lastInsertId();

		return $post_id;
	}
	
	public function getPostsByUserID($user_id) {
		$query = $this->conn->prepare("SELECT * FROM post WHERE user_id = :user_id;");
		$query->bindParam(':user_id',$user_id);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$posts = $query->fetchAll();
		
		return $posts;
	}
}
?>