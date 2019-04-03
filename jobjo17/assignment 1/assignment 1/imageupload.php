<?php
session_start();
if ( isset( $_SESSION['user_id'] ) ) {	
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: index.php");
}
if(!empty($_POST)) {
	if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['image'])) {  
	$tmpname = $_POST['image'];
	$fp = fopen($_POST['image'], 'rb'); // read binary
	try {
	require_once('db_config.php');
	$conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("INSERT INTO images (uploadedby,description,title,image) 
	VALUES (:uploadedby,:description,:title,:image)");
	$stmt->bindParam(':uploadedby', $_SESSION['user_id']);
	$stmt->bindParam(':description', $_POST['description']);
	$stmt->bindParam(':title', $_POST['title']);
	$stmt->bindParam(':image', $fp, PDO::PARAM_LOB);
	$stmt->execute();
	header("Location: uploadpicture.php");
	}catch(PDOException $e)
	{
	'Error : ' .$e->getMessage();
	}
	}
	} else {
	header("Location: uploadpicture.php");
	}
	


?>