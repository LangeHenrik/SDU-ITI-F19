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

    public function uploadImage($username, $blob_data, $title, $description, $type) {

        $image_base64 = base64_encode($blob_data);
        $statement = $this->conn->prepare('insert into images (username, blob_data, title, description, extension) values (:username, :blob_data, :title, :description, :extension);');

        $statement->bindParam(':username', $username);
        $statement->bindParam(':blob_data', $image_base64);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':extension', $type);

        $statement->execute();

    }

}