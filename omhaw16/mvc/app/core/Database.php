<?php
$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);   
 include $pathroot . '/omhaw16/mvc/app/core/DBConfig.php';

 class Database extends DBConfig {

 	function connectToDB() {

 		$dbcon = new DBConfig();

		$conn = new mysqli($dbcon->servername, $dbcon->username, $dbcon->userpass, $dbcon->dbname);

		return $conn;

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {   
    	print("Connected thru new method!");
    } 
}
}

/*
require_once 'serverconn.php';
	
class Database extends ServerConn {

	public $conn;
	
	public function __construct() {
		try {
			
			$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",
			$this->username,
			$this->password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	
	public function __destruct() {
		$this->conn = null;
	}
	
}*/
?>