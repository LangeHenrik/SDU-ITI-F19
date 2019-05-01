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

    function getUsersAndID (){
        $statement = $this->conn->prepare("SELECT user_id, username FROM Users");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result;
    }

    function getPicturesFromID($user_id) {
        $statement = $this->conn->prepare("SELECT * FROM mifor16.images WHERE username = (SELECT username FROM mifor16.users WHERE user_id = :user_id);");
        $statement->bindParam(':user_id', $user_id);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}