<html>
	<h1> Hello World </h1>
</html>

<?php

	require_once 'db_config.php';

    try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		echo "Connected to $dbname at $servername successfully.";
	} catch (PDOException $pe) {
		die("Could not connect to the databae $dbname : " . $pe->getMessage());
	}
?>

