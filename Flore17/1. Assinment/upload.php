<?php
//
require_once 'db_config.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $servername successfully.";
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//htmlentities for xxs defence
	$header = htmlentities($_POST['postHeader']);
	$comm = htmlentities($_POST['subject']);
	$imagename=htmlentities($_FILES["imageToUpload"]["name"]);	
	$type=htmlentities($_FILES["imageToUpload"]["type"]); //get file extension
	$imagetmp= file_get_contents($_FILES['imageToUpload']['tmp_name']); //gets file content for DB blob
	
	if(!isset($header) || $header == "" || !isset($comm) || $comm == "" || $_FILES['imageToUpload']['error'] > 0){
		$conn = null;
		header('Location: Pictures.php');
	}
	
	$stmt = $conn->prepare("INSERT INTO posts (imagename, exttype, imagetmp, header, comm) VALUES (:imagename, :type, :imagetmp, :header, :comm)");
	
	//bindParam for sql injection defence
	$stmt->bindParam(":imagename", $imagename);
	$stmt->bindParam(":type", $type);
	$stmt->bindParam(":imagetmp", $imagetmp, PDO::PARAM_LOB); //bindparam for a DB Longblob
	$stmt->bindParam(":header", $header);
	$stmt->bindParam(":comm", $comm);
	
	$stmt->execute();
	
	echo "New record created successfully";
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

$header = "";

$comm = "";

$conn = null;

header('Location: Pictures.php');

?>
