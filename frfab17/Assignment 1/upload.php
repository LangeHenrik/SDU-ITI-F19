<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "imagepage.php";
require_once "db_config.php";

$title = htmlentities($_POST["title"]);
$desc = htmlentities($_POST["description"]);
$path = "images/";
$target_file = $path . basename($_FILES["filePath"]["name"]);
$image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$isValidImage = getimagesize($_FILES["filePath"]["tmp_name"]);

if($isValidImage == true){
	if($image_type == "jpg" || $image_type == "jpeg" || $image_type == "png"){
		if(move_uploaded_file($_FILES["filePath"]["tmp_name"], $target_file)){
			$sql = "SELECT id FROM user WHERE username = :username;";
			$statement = $con -> prepare($sql);
			$statement -> bindParam(":username", $_SESSION['user']);
			$statement -> execute();
			$user_id = $statement -> fetch(PDO::FETCH_ASSOC);
			
			$sql = "INSERT INTO images (userid, uploaddate, header, description, path) VALUES (:userid, NOW(), :header, :description, :path);";
			$statement = $con -> prepare($sql);
			$statement -> bindParam(":userid", $user_id['id']);
			$statement -> bindParam(":header", $title);
			$statement -> bindParam(":description", $desc);
			$statement -> bindParam(":path", $target_file);
			$statement -> execute();
			
			echo "Success";
			header("Location:imagepage.php");
		}
	}
}