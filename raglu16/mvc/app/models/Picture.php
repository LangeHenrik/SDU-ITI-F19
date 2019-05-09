<?php
class Picture extends Database {
	
	public function uploadPicture(){

		$target_dir = "images/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
		$i = 0;

		//change filename if it already exists
		while (file_exists($target_file)) {
			$i++;
			$target_file = str_replace(".", "_" . $i . ".", $target_file);
		}
		
		$sql = "INSERT INTO images(title,description,source,user_id) VALUES(:title,:description,:source,:user_id)";
		
		if($stmt = $this->conn->prepare($sql) and move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
			
			$stmt->bindParam(":title", $param_title, PDO::PARAM_STR);
			$stmt->bindParam(":description", $param_description, PDO::PARAM_STR);
			$stmt->bindParam(":source", $target_file, PDO::PARAM_STR); 
			$stmt->bindParam(":user_id", $param_user_id, PDO::PARAM_STR); 
	
			$param_title = trim($_POST["title"]);
			$param_description = trim($_POST["description"]);
			$param_user_id = $_SESSION["user_id"];		
				
			if($stmt->execute()){
				echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
			} else {
				unlink($target_file);
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}

	public function getUserPictures($userId){
		$sql = "SELECT * FROM images WHERE user_id = :user_id";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam('user_id', $userId);
		$stmt->execute;
		$pictures = $stmt->fetchAll();

		return $pictures;
	}
	
	public function postPicture($title, $description, $image){
		$sql = "INSERT INTO images (title, description, source, user_id) VALUES(:title, :description, :source, :user_id)";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam('title', $title);
		$stmt->bindParam('description', $description);
		$stmt->bindParam('source', $image);
		$stmt->bindParam('user_id', $_SESSION['user_id']);
		
		$stmt->execute();
		$user_id = $this->conn->lastInsertId();
		
		return $user_id;
	}
}