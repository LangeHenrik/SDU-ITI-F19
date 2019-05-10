<?php
class Picture extends Database {
	
	public function getAllPictures(){
		$sql = "SELECT * FROM pictures";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$pictures = $stmt->fetchAll();

		return $pictures;
	}

}