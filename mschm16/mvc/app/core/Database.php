<?php
$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);   
include $pathroot . '/mschm16/mvc/app/core/DBConfig.php';

 class Database extends DBConfig {

 	function connectToDB() {

 		$dbcon = new DBConfig();
		$conn = new mysqli($dbcon->servername, $dbcon->username, $dbcon->userpass, $dbcon->dbname);
		return $conn;

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} else {   
			print("Connected");
		} 
	}
}
?>