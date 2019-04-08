<?php
session_start();
require_once 'db_config.php';

try {
    $sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$picture = $_FILES['imageToUpload'];
	$user = htmlentities($_SESSION['username']);
	$created = date("Y-m-d H:i:s");
	$title = htmlentities($_POST['title']);
	$comment = htmlentities($_POST['comment']);
	$likes = 0; 
	
	print_r($_FILES['imageToUpload']);
	
	$imagename=$_FILES['imageToUpload']['name'];
	$type = $_FILES['imageToUpload']["type"];
	$image = file_get_contents($_FILES['imageToUpload']['tmp_name']); //SQL Injection defence!

	$sql_code = "INSERT INTO picture (picture_user, picture_created, picture_title, picture_comment, picture_likes, picture_type, picture) 
	VALUES (:username, :created , :title, :comment, :likes, :image_type, :image)";
	$stmt = $sql->prepare($sql_code);
	
	$stmt->bindParam("username", $user);
	$stmt->bindParam("created", $created);
	$stmt->bindParam("title", $title);
	$stmt->bindParam("comment", $comment);
	$stmt->bindParam("likes", $likes);
	$stmt->bindParam("image_type", $type);
	$stmt->bindParam("image", $image, PDO::PARAM_LOB);
	
	$stmt->execute();
	
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

header('Location: picture.php');	
?>
