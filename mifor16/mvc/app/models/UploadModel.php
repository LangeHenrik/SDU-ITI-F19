<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 10:26
 */


namespace models;

use core\Database;
use PDO;

class UploadModel extends Database
{

    public function uploadImage($username, $blob_data, $title, $description) {
        $statement = $this->conn->prepare('insert into images (username, blob_data, title, description) values (:username, :blob_data, :title, :description);');

        $statement->bindParam(':username', $username);
        $statement->bindParam(':blob_data', $blob_data);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);

        $statement->execute();

    }

}