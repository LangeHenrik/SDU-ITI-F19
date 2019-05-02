<?php

namespace core;

require_once 'db_config.php';
use PDO;

	
class Database extends DB_Config {

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

    function checkUserExists($ausername) {
        $statement = $this->conn->prepare('select username from users where username = :username;');
        $statement->bindParam(':username', $ausername);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();

        $count = count($result);
        if ($count >= 1) {
            return true;
        } else {
            return false;
        }
    }
	
}