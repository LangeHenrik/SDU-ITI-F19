<?php
class Picture extends Database {
	
	public function getAllPictures(){
		$sql = "SELECT * FROM posts";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$pictures = $stmt->fetchAll();

		return $pictures;
	}

}