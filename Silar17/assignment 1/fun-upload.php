<?php
session_start();
require_once 'db_config.php';

try {
    $sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//$image = addslashes(file_get_contents($_FILES['picture']['tmp_name'])); //SQL Injection defence!
	$title = htmlspecialchars(strip_tags($_POST['title']));
	$comment = htmlspecialchars(strip_tags($_POST['comment']));
	$created = date("Y-m-d H:i:s");
	$user = htmlspecialchars(strip_tags($_SESSION['username']));
	$info = getimagesize($_FILES['picture']['tmp_name']);
	$type = $info['mime'];
	$image = fopen($_FILES['picture']['tmp_name'], 'rb');
	//$picture = file_get_contents($image);
	$sql_code = "INSERT INTO picture (picture_user, picture_created, picture_title, picture_comment, picture_likes, picture_type, picture) VALUES ('{$user}','{$created}' ,'{$title}', '{$comment}','0',?, ?)";
	$stmt = $sql->prepare($sql_code);
	$stmt->bindParam(1, $type);
	$stmt->bindParam(2, $image, PDO::PARAM_LOB);
	$stmt->execute();
	
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
$sql = null;

header('Location: picture-upload.php');

?>
