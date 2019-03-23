<?php
session_start();
$tablename = 'picture';
		require_once('db_config.php');
		$conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$st = $conn->prepare("SELECT description, picture, user FROM picture");
		$st->bindColumn(1, $description);
		$st->bindColumn(2, $lob, PDO::PARAM_LOB);
		$st->bindColumn(3, $uploadedby);
		$st->execute();
		$results = $st->fetchAll(PDO::FETCH_BOUND);
		header("Content-Type: image/png");
		echo $lob;

?>

