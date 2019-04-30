<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 30-04-2019
 * Time: 13:23
 */

namespace models;

use PDO;
use core\Database;

class APIModel extends Database
{
    function id_and_usernames(){
        $statement = $this->conn->prepare('SELECT user_id, username FROM users');
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    function get_pictures_from_id($user_id){
        $statement = $this->conn->prepare('SELECT * FROM images WHERE username = (SELECT username FROM users where user_id = :user_id)');
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result;
    }

}