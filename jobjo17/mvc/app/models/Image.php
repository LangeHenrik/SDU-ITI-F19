<?php
class Image extends Database {
	
	public $image_id;
	public $title;
	public $description;
	public $uploadedby;
	public $image;

	public function create($input2,$input3,$input4,$input5){
		$this->title = filter_var($input2,FILTER_SANITIZE_STRING);
		$this->description = filter_var($input3,FILTER_SANITIZE_STRING);
		$this->uploadedby = filter_var($input4,FILTER_SANITIZE_STRING);
		$this->image = $input5;

		
	}
	
	public function retrieveAll() {
		$images = array();
		$stmt = $this->conn->prepare("SELECT images.id,title,description,image,users.username FROM images LEFT JOIN users ON uploadedby = users.id");

		$results = array();
		if ($stmt->execute()) {
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$results[] = $row;
		}
}		
		foreach($results as $result) {
			$tempImage = new Image();
			$tempImage->id = $result['id'];
			$tempImage->title = $result['title'];
			$tempImage->description = $result['description'];
			$tempImage->uploadedby = $result['username'];
			$tempImage->image = $result['image'];
			array_push($images, $tempImage);
		}		
		return $images;
	}

	public function apiRetrieveForUser($user_id) {
		$stmt = $this->conn->prepare("SELECT image ,title,description FROM images WHERE uploadedby = :id");
		$stmt->bindParam(':id', $user_id);
		$results = array();
		if ($stmt->execute()) {
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$results[] = $row;
		}
		}		
		return $results;
	}
	public function upload() {
		//using user inputted title instead of file name
		$stmt = $this->conn->prepare("INSERT INTO images(title,description,uploadedby,image) 
		VALUES(:title,:description,:uploadedby,:image)");
		$stmt->bindParam(':title', $this->title);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':uploadedby', $this->uploadedby);
		$stmt->bindParam(':image', $this->image, PDO::PARAM_LOB);
		
		

		try{
			$stmt->execute();
			$id = $this->conn->lastInsertId();
			return $id;
			$_SESSION['error'] = "Registration successful, you can now log in!";
		} catch(Exception $e) {
			$_SESSION['error'] = "Username already exists";
		}
	
	}

}