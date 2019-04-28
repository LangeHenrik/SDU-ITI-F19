<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-27
 * Time: 10:25
 */

require_once 'UserDAO.php';


class ImageDAO extends Connection {


    private $conn = null;


    public function __construct()
    {
        parent::__construct();
        $this->conn = parent::getConnection();
    }


    public function saveImage($image) {
        $imageHeader = htmlentities($image->getHeader());
        $imageText = htmlentities($image->getText());
        $imageFileName = htmlentities($image->getFileName());
        $userId = htmlentities($image->getUserId());

        $query = "INSERT INTO images(header, text, name, user_id) VALUES(:header, :text,:filename, :user_id);";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':header',$imageHeader);
        $statement->bindParam(':text', $imageText);
        $statement->bindParam(':filename', $imageFileName);
        $statement->bindParam(':user_id', $userId);
        $success = $statement->execute();

        if($success) {
            $imageID = $this->conn->lastInsertId();;
            return $imageID;
        }
        else {
            return -1;
        }


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

    function getImageComments($imageId)
    {
        $query = "SELECT * FROM comments where image_id = :imageId";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':imageId', $imageId);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($comments != null) {
            return $this->convertToCommentsArray($comments);
        }

    }


    public function getUserImages($userid)
    {
        $query = "SELECT * FROM images where user_id = :userid";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':userid', $userid);
        $statement->execute();
        $images = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($images != null) {
            return $this->convertToImagesArray($images);
        } else {
            return null;
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

        $imageID = $fetchedImage['id'];
        $comments = $this->getImageComments($imageID);

        $image = new Image();
        $image->setFileName($fetchedImage["name"]);
        $image->setHeader($fetchedImage['header']);
        $image->setId($fetchedImage['id']);
        $image->setText($fetchedImage['text']);
        $image->setUserId($fetchedImage['user_id']);

        $image->setComments($comments);

        return $image;

    }
    private function convertToCommentsArray($fetchedComments)
    {
        $comments = array();
        if (is_array($fetchedComments)) {
            foreach ($fetchedComments as $fetchedComment) {
                $comment = $this->convertDBCommentToComment($fetchedComment);
                array_push($comments, $comment);
            }
            return $comments;
        } elseif($fetchedComments instanceof Comment) {
            return $this->convertDBCommentToComment($fetchedComments);
        }
    }

    private function convertDBCommentToComment($fetchedComment) {

        $userDAO = new UserDAO();
        $authorName = $userDAO->getUserName($fetchedComment['user_id']);

        $comment = new Comment();
        $comment->setAuthorID($fetchedComment['user_id']);
        $comment->setComment($fetchedComment['comment']);
        $comment->setImageID($fetchedComment['image_id']);
        $comment->setPostDate($fetchedComment['post_date']);
        $comment->setAuthorUsername($authorName);

        return $comment;
    }



}