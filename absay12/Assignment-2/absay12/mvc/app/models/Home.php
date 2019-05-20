<?php

class Home extends Database {

	public function getAllPictures() {

    $sql = "SELECT person, title, description, picture_file FROM picture ORDER BY date_uploaded DESC LIMIT 20";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$pictures = $stmt->fetchAll();
		return $pictures;
  	}	
}