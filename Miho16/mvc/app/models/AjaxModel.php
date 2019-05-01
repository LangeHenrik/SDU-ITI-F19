<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:38
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
