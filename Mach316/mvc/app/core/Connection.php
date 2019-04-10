<?php

require 'db_config.php';

class Connection
{
    private $conn = null;

    public function __construct()
    {
        if($this->conn == null) {
            $this->conn = getConnection();
        }
    }

    public function getConnection() {
        return $this->conn;
    }


}
