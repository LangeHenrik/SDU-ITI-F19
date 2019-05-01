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
        $statement = $this->conn->prepare('SELECT * FROM images WHERE username = (SELECT username FROM users where user_id = :user_id) ORDER BY image_id DESC');
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result;
    }

    public function upload_picture_and_return_id($username, $blob, $title, $description, $type){
        $statement = $this->conn->prepare('insert into images (username, image, extension, title, description) values (:username, :image, :extension, :title, :description);');
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