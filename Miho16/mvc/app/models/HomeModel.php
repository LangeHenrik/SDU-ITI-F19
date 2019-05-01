<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:38
 */
namespace models;
use PDO;
use core\Database;
class HomeModel extends Database
{
    public function upload_picture($username, $blob, $title, $description, $type){
        $image = base64_encode($blob);
        $statement = $this->conn->prepare('insert into images (username, image, extension, title, description) values (:username, :image, :extension, :title, :description);');
        $statement->bindParam(':username', $username);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':extension', $type);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);
        $statement->execute();
    }
    public function get_20_posts(){
        $statement = $this->conn->prepare('SELECT * FROM images ORDER BY image_id DESC LIMIT 20');
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}
