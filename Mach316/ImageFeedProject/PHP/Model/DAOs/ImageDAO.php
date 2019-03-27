<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 10:25
 */

class ImageDAO extends DAO{

    private $conn = null;

    public function __construct()
    {
        $this->conn = parent::$conn;
    }


    function getAllImages()
    {
        $query = "SELECT * FROM images;";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $images = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($images != null) {
            return $images;
        }

    }

    function getUserImages()
    {
        $userid = $_SESSION['id'];
        $query = "SELECT * FROM images where user_id = :userid";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':userid', $userid);
        $statement->execute();
        $images = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($images != null) {
            return $images;
        }
    }

    function getUserImagesById($userid)
    {
        $conn = getConnection();

        $query = "SELECT * FROM images where user_id = :userid";
        $statement = $conn->prepare($query);
        $statement->bindParam(':userid', $userid);
        $statement->execute();
        $images = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($images != null) {
            return $images;
        }
    }

    function deleteImage($imageId)
    {

        $imageId = (int)$imageId;
        $conn = getConnection();
        $query = "DELETE FROM images where id = :imageId;";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':imageId', $imageId);
        $success = $statement->execute();

        return $success;
    }
}