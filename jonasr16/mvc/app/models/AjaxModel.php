<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 30-04-2019
 * Time: 11:15
 */

namespace models;
use core\Database;
use PDO;

class AjaxModel extends Database
{
    function get_all_usernames(){
        $statement = $this->conn->prepare('SELECT username FROM users');
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}
