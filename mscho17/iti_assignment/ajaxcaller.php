<?php

	require_once 'db_config.php';
	$offset = $_GET["numm"];
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$stmt = $conn->prepare("SELECT * FROM post limit 20 offset $offset");

	$stmt -> execute();	
	$result = $stmt->fetchAll();
	
	foreach ($result as $value){
		$picturepath = $value["post_picture_location"];
		$picturetitle = $value["post_title"];
		
		
		echo "<div class='pictureframes'>";
		echo "<label>$picturetitle</label>"; 
		echo "<img src='$picturepath'>";
		echo "</div>";
		
	}

