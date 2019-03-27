<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 10:25
 */

class ImageDAO extends DAO{

    private $conn = null;

    public function __construct()
    {
        $this->conn = parent::$conn;
    }

}