<?php

require_once 'db_config.php';
	
class Database extends DB_Config {

	public $conn1;
    protected $servername = '';

	public function __construct() {
	    $servername = parent::getServername();
	    $dbname = parent::getDBName();
	    $username = parent::getUsername();
	    $password = parent::getPassword();

		try {
            $this->conn1 = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname,
            $username,
            $password,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	
	public function __destruct() {
		$this->conn1 = null;
	}

    /**
     * @return PDO
     */
    public function getConn()
    {
        return $this->conn1;
    }

}