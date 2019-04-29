<?php
	session_start();
	require_once 'db_config.php';

	try {

		$sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			
		$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql_code ="
		SELECT * from picture
		where picture_user = :user_username";
		
		$stmt = $sql->prepare($sql_code);
		
		$stmt->bindparam(":user_username", $_GET['picture_user']);
		$stmt->execute();

		$stmt->setFetchMode(PDO::FETCH_ASSOC);

		$array = $stmt->fetchALL();

		if(!empty($array[0]['picture'])) {
			header("Content-type: ".$array[0]['picture_type']);
			echo $array[0]['picture'];
			
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
