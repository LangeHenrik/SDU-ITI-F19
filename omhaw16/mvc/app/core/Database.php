<?php

 class Database extends DBConfig {

	$conn = new mysqli($servername, $username, $userpass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {   
    	print("Connected hereee!");
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