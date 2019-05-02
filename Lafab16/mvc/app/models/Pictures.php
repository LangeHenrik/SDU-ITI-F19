<?php
//require_once "../core/Database.php";
class pictures extends Database {

	public function getAllPictures(){

	  $sql = $this->conn -> prepare("SELECT * from image order by image_id desc");
		$sql -> execute();
		if ($sql->rowCount() > 0) {
			$pictures = $sql->fetchall(PDO::FETCH_NAMED);
			return $pictures;
	}

}
	public function getById($id){
		$sql = $this->conn -> prepare("SELECT * from image Where idus = :id order by image_id desc");
		$sql -> bindParam(':id' , $id);

		$sql -> execute();
		$pictures = $sql->fetchall(PDO::FETCH_NAMED);
		return $pictures;
	}


public function uploadPicture(){
		$file = $_FILES['file'];
		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];
  	$description = htmlspecialchars($_POST['description'], ENT_QUOTES) ;
$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));
$allowed = array('jpg', 'jpeg', 'png', 'gif' );
if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			$filedestination = "../app/uploades/".uniqid('', true).".".$fileActualExt;

			$movedfile = move_uploaded_file($_FILES["file"]["tmp_name"], $filedestination);
			$path = $filedestination;
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 = base64_encode($data);






						$stmt = $this->conn->prepare("INSERT INTO image(idus, username, title, description, image)
				VALUES (:idus, :user, :pat, :des, :bl);");
$userid= $_SESSION['user_id'];
$usernames=$_SESSION['username'];

						$stmt->bindParam(':idus', $userid );
						$stmt->bindParam(':user', $usernames);
						$stmt->bindParam(':bl', $base64, PDO::PARAM_LOB);
						$stmt->bindParam(':des', $description );
						$stmt->bindParam('', );
						$stmt -> execute();
	}
}
}
}
