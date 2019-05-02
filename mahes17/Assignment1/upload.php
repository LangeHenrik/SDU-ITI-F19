<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "pictures.php";
require_once "db_config.php";

$img_title = htmlentities($_POST["img_title"]);
$img_desc = htmlentities($_POST["img_desc"]);
$path = "uploads/";
$target_file = $path . basename($_FILES["fileToUpload"]["name"]);
$image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$isValidImage = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

if($isValidImage == true){
	if($image_type == "jpg" || $image_type == "jpeg" || $image_type == "png" || $image_type == "gif"){
		if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
			//Get user id
			$sql = "SELECT user_id FROM users WHERE username = :username;";
			$stmt = $conn -> prepare($sql);
			$stmt -> bindParam(":username", $_SESSION['user']);
			$stmt -> execute();
			$user_id = $stmt -> fetch(PDO::FETCH_ASSOC);

			//Upload picture info to db
			$sql = "INSERT INTO pictures (img_userid, img_uploaddate, img_header, img_desc, img_path) VALUES (:img_userid, NOW(), :img_header, :img_desc, :img_path);";
			$stmt = $conn -> prepare($sql);
			$stmt -> bindParam(":img_userid", $user_id['user_id']);
			$stmt -> bindParam(":img_header", $img_title);
			$stmt -> bindParam(":img_desc", $img_desc);
			$stmt -> bindParam(":img_path", $target_file);
			$stmt -> execute();

			echo "Success";
			header("Location: pictures.php");
		}
	}
}
