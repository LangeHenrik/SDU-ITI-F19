<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/core/db_config.php';

class Database extends DB_Config {

	private $conn;
	
	public function __construct() {
		try {
			//remember that the variables: username and password are separated by commas!
			$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",
			$this->username,
			$this->password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		
	}

	public function getConn() {
		return $this->conn;
	}
	
	public function __destruct() {
		$this->conn = null;
	}

	
	
}
