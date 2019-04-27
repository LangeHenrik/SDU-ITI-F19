<?php

require_once 'db_config.php';
	
class Database extends DB_Config {
	private static $database;

	public $conn;
	
	public function __construct() {
		try {
			$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",
			$this->username,
			$this->password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch (PDOException $e) {
			throw $e;
		}
	}
	
	public function __destruct() {
		$this->conn = null;
	}
	
	public static function get() {
		if(self::$database == null) self::$database = new Database();
		return self::$database;
	}
}