<?php
	require_once 'db_config.php';
	
	try {
		
		$conn = new PDO("mysql:host=$servername; dbname=$dbname",
		$username,
		$password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		/*
		$stmt = $conn-> prepare("SHOW DATABASES");
		
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt->fetchAll();
		print_r($result); */
		
	} catch (PDOException $e){
		
		echo "Error: " . $e->getMessage();
		
	}
	
	//$conn = null;