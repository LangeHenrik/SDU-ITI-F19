<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 10:32
 */


include 'db_config.php';

class DAO {

    protected static $conn = null;

    public function __construct()
    {
        if($this->conn == null) {
            $this->conn = getConnection();
        }
    }
}