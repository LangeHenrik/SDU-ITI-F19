<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 10:57
 */

namespace models;

use core\Database;
use PDO;

class UsersModel extends Database
{
    function getUsers (){
        $statement = $this->conn->prepare("SELECT * FROM Users");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result;
    }

}