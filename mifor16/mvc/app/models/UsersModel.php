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

    public function upload_picture_and_return_id($username, $blob, $title, $description, $type){
        $statement = $this->conn->prepare('insert into images (username, blob_data, extension, title, description) values (:username, :image, :extension, :title, :description);');
        $statement->bindParam(':username', $username);
        $statement->bindParam(':image', $blob);
        $statement->bindParam(':extension', $type);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);
        $statement->execute();

        $statement2 = $this->conn->prepare('SELECT * FROM images WHERE image_id = (SELECT MAX(image_id) FROM images)');
        $statement2->execute();
        $statement2->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement2->fetchAll();
        return $result;
    }
}