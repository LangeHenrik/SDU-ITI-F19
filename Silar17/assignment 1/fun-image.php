<?php
	session_start();
	require_once 'db_config.php';

	try {

		$sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			
		$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql_code = "SELECT picture_created, picture_user, picture_type, picture 
		FROM silar17.picture
		order by picture_created desc";
		
		$stmt = $sql->prepare($sql_code);
		$stmt->execute();

		$stmt->setFetchMode(PDO::FETCH_ASSOC);

		$array = $stmt->fetchALL();
		$index = $_GET['picture_index'];
		
		if(!empty($array[$index]['picture'])) {
			header("Content-type: ".$array[$index]['picture_type']);
			echo $array[$index]['picture'];
			
		} else {
			$filename = "images/nopic.jpg";
			$picture = fopen($filename, "rb");
			$contents = fread($picture, filesize($filename));
			fclose($picture);
			header("content-type: image/jpeg");
			echo $contents;
		}
	} catch (PDOException $pe) {
		die("Could not connect to the database $dbname :" . $pe->getMessage());
	}
?>
