<?php

require_once 'db_config.php';
	
class Database extends DB_Config {

	public $conn1;
    protected $servername = '';

	public function __construct() {
	    $servername = parent::getDBServername();
	    $dbname = parent::getDBName();
	    $username = parent::getDBUsername();
	    $password = parent::getDBPassword();

		try {
            $this->conn1 = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname,
            username,
            password,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


			/*$this->conn1 = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname,
			$this->username,
			$this->password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));*/
			
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	
	public function __destruct() {
		$this->conn1 = null;
	}

	public function getConn(){
	    return this::$conn1;
    }
}