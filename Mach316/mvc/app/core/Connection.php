<?php

require 'db_config.php';

class Connection
{
    protected static $conn = null;

    public function __construct()
    {
        echo "Construct connection!";
        if($this->conn == null) {
            $this->conn = getConnection();
        }
    }


}
