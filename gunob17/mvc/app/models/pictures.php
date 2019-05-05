<?php
//require_once "../core/Database.php";
class pictures extends Database {

	public function getAllPictures(){

	  $sql = $this->conn -> prepare("SELECT * from pictures order by idpic desc");
		$sql -> execute();
		if ($sql->rowCount() > 0) {
			$pictures = $sql->fetchall(PDO::FETCH_NAMED);
			return $pictures;
	}

}
	public function getById($id){
		$sql = $this->conn -> prepare("SELECT * from pictures Where idus = :id order by idpic desc");
		$sql -> bindParam(':id' , $id);

		$sql -> execute();
		$pictures = $sql->fetchall(PDO::FETCH_NAMED);
		return $pictures;
	}
	

public function uploadPicture($FILES){
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
			//$filedestination = "../uploades";
			//$movedfile = move_uploaded_file(  $fileTmpName, "$filedestination/$newnamefile");
			$movedfile = move_uploaded_file($_FILES["file"]["tmp_name"], $filedestination);
			//$movedfile = move_uploaded_file($_FILES["file"]["tmp_name"], "../uploades".uniqid('', true).".".$fileActualExt);
			if ($movedfile) {
				echo 'Successfully uploaded';
				echo $filedestination;
				echo $movedfile;
			}else {
				echo 'Not uploaded because of error #'.$_FILES["file"]["error"];
			}
			$path = $filedestination;
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 = base64_encode($data);
			//$blob = base64_decode($base64);
			$blob = fopen($path, 'r');




						$stmt = $this->conn->prepare("INSERT INTO pictures(idpic, idus, username, name, description, bl)
				VALUES (null, :idus, :user, :pat, :des, :bl);");
$userid= 1;
$usernames="peter";
$berewa = "jaiefowaejfweoifweiofnwe";
						$stmt->bindParam(':idus', $userid );
						$stmt->bindParam(':user', $usernames);
						$stmt->bindParam(':bl', $base64, PDO::PARAM_LOB);
						$stmt->bindParam(':des', $description );
						$stmt->bindParam(':pat', $filedestination);
						//$stmt ->fetch(PDO::FETCH_BOUND);
						//echo $stmt -> getAttribute();
						$stmt -> execute();
	}
}
}
}
