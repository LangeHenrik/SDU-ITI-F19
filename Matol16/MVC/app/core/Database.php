<?php
    require_once 'db_config.php';

    class Database extends DB_Config {
        public $connection;

        public function __construct()
        {
            try{
                $this->connection = new PDO("mysql:host=$this->DB_servername;dbname=$this->DB_name",
                    $this->DB_username,
                    $this->DB_password,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch(PDOException $e){
                echo 'Error: ' . $e->getMessage();
            }
        }
        public function __destruct()
        {
            $this->connection = null;
        }
    }