<?php


class Picture extends Database {

	
	
	public function getAllPictures(){
		$sql = "SELECT * from posts";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$pictures = $stmt->fetchAll();
		return $pictures;

	}	

	public function getPicById($id){
		$sql = "SELECT * from posts WHERE uploaded_by = :id;";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam('id',$id,PDO::PARAM_INT);
		$stmt->execute();
		$picturesById = $stmt->fetchAll();

		return $picturesById;

	}	

}