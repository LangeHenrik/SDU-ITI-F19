<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

class Picture extends Database {
	public $name, $header, $comm, $imagename, $type, $imagetmp;

	public function getAllPosts() {

		$sql = "Select * From posts ORDER BY image_id";

		$stmt = $this->conn->prepare($sql);

		$stmt->execute();

		$posts = $stmt->fetchAll();

		return $posts;
	}

	public function uploadPic() {
		if(!isset($_POST['postHeader']) || $_POST['postHeader'] == "" || !isset($_POST['subject']) || $_POST['subject'] == "" || $_FILES['imageToUpload']['error'] > 0){
			
		} else {

		$header = htmlentities($_POST['postHeader']);
		$comm = htmlentities($_POST['subject']);
		$imagename = htmlentities($_FILES["imageToUpload"]["name"]);	
		$type = htmlentities($_FILES["imageToUpload"]["type"]); //get file extension
		$imagetmp = file_get_contents($_FILES['imageToUpload']['tmp_name']); //gets file content for DB blob

		$sql = "Select * From posts";

		$stmt = $this->conn->prepare($sql);

		$stmt->execute();

		if ($stmt->rowCount() == 0) {
			$image_id = 0;
		} else {
			$image_id = $stmt->rowCount();
		}

			$sql = "INSERT INTO posts (imagename, exttype, imagetmp, header, comm, image_id) VALUES (:imagename, :type, :imagetmp, :header, :comm, :image_id)";

			$stmt = $this->conn->prepare($sql);

			//bindParam for sql injection defence
			$stmt->bindParam(":imagename", $imagename);
			$stmt->bindParam(":type", $type);
			$stmt->bindParam(":imagetmp", $imagetmp, PDO::PARAM_LOB); //bindparam for a DB Longblob
			$stmt->bindParam(":header", $header);
			$stmt->bindParam(":comm", $comm);
			$stmt->bindParam(":image_id", $image_id);
	
			$stmt->execute();
		}

		$header = "";
		$comm = "";
	}

	public function uploadPicDB($header, $comm, $imagetmp, $ext) {

		$imagename = 'Unknown';

		$sql = "Select * From posts";

		$stmt = $this->conn->prepare($sql);

		$stmt->execute();

		if ($stmt->rowCount() == 0) {
			$image_id = 0;
		} else {
			$image_id = $stmt->rowCount();
		}

		$sql = "INSERT INTO posts (imagename, exttype, imagetmp, header, comm, image_id) VALUES (:imagename, :type, :imagetmp, :header, :comm, :image_id)";

		$stmt = $this->conn->prepare($sql);
	
		//bindParam for sql injection defence
		$stmt->bindParam(":imagename", $imagename);
		$stmt->bindParam(":type", $ext);
		$stmt->bindParam(":imagetmp", $imagetmp, PDO::PARAM_LOB); //bindparam for a DB Longblob
		$stmt->bindParam(":header", $header);
		$stmt->bindParam(":comm", $comm);
		$stmt->bindParam(":image_id", $image_id);
	
		$stmt->execute();

		$header = "";
		$comm = "";

		return $image_id;
	}

}

?>