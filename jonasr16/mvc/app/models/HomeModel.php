<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 29-04-2019
 * Time: 16:11
 */

namespace models;
use PDO;
use core\Database;
class HomeModel extends Database
{
    public function upload_picture($username, $path, $title, $description){
        $statement = $this->conn->prepare('insert into images (username, path, title, description) values (:username, :path, :title, :description);');
        $statement->bindParam(':username', $username);
        $statement->bindParam(':path', $path);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);

        $statement->execute();
    }

    public function get_20_posts(){
        $statement = $this->conn->prepare('SELECT * FROM images ORDER BY id DESC LIMIT 20');
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }


}