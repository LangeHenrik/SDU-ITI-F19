<?php
session_start();
		require_once('db_config.php');
		$conn = new PDO("mysql:host=$servername;port=3307;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT description,image,uploadedby FROM images");
		$stmt->bindColumn(1, $description);
		$stmt->bindColumn(2, $lob, PDO::PARAM_LOB);
		$stmt->bindColumn(3, $uploadedby);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_BOUND);
		header("Content-Type: image/png");
		print_r($lob);

?>