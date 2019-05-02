<?php
require_once 'Db_config.php';
class Database extends DB_Config
{
    public $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function __destruct()
    {
        $this->conn = null;
    }
}
