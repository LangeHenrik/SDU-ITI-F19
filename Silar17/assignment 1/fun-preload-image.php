<?php
session_start();
if (!isset($_SESSION['preload'])){
	$_SESSION['preload'] = false;
require_once 'db_config.php';
echo $_SESSION['preload'];

try {
    $sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// making dommy users-picuters with picture uploads
	for ($i = 1; $i < 22; $i = $i + 1){
	
	$user = "User{$i}";
	$created = date("Y-m-d H:i:s");
	$title = "title{$i}";
	$comment = "comment{$i}";
	$likes = $i;
	$filename = "images/picture".$i.".jpg";
	$picture = fopen($filename, "rb");
	$image = fread($picture, filesize($filename));
	fclose($picture);
	$type = 'image/jpeg';
	
	$sql_code = "INSERT IGNORE INTO picture (picture_user, picture_created, picture_title, picture_comment, picture_likes, picture_type, picture) 
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
	sleep(1);
	}
	
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
$sql = null;
}
header('Location: index.php');	
?>