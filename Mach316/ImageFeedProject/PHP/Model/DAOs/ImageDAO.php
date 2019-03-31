<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 10:25
 */

class ImageDAO extends DAO implements iImageDAO {

    private $conn = null;

    public function __construct()
    {
        $this->conn = parent::$conn;
    }


    public function getAllImages()
    {
        $query = "SELECT * FROM images;";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $images = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($images != null) {
            return $this->convertToImagesArray($images);
        }
    }


    public function getUserImages()
    {
        $userid = $_SESSION['id'];
        $query = "SELECT * FROM images where user_id = :userid";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':userid', $userid);
        $statement->execute();
        $images = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($images != null) {
            return $this->convertToImagesArray($images);
        }
    }

    public function getUserImagesById($userid)
    {
        $conn = getConnection();

        $query = "SELECT * FROM images where user_id = :userid";
        $statement = $conn->prepare($query);
        $statement->bindParam(':userid', $userid);
        $statement->execute();
        $images = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($images != null) {
            return $this->convertToImagesArray($images);
        }
    }

    public function deleteImage($imageId)
    {

        $imageId = (int)$imageId;
        $conn = getConnection();
        $query = "DELETE FROM images where id = :imageId;";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':imageId', $imageId);
        $success = $statement->execute();

        return $success;
    }

    private function convertToImagesArray($fetchedImages) {
        $images = array();
        foreach($fetchedImages as $fetchedImage) {
            $image = $this->convertDBImageToImage($fetchedImage);
            array_push($images, $image);
        }
        return $images;
    }

    private function convertDBImageToImage($fetchedImage) {
        $image = new Image();
        $image->setFileName($fetchedImage["name"]);
        $image->setHeader($fetchedImage['header']);
        $image->setId($fetchedImage['id']);
        $image->setText($fetchedImage['text']);
        $image->setUserId($fetchedImage['user_id']);
        return $image;

    }


}