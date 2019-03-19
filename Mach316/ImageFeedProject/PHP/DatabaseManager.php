<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-12
 * Time: 18:50
 */

include 'db_config.php';
session_start();


function getAllImages()
{
    $conn = getConnection();

    $query = "SELECT * FROM images;";
    $statement = $conn->prepare($query);
    $statement->execute();
    $images = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($images != null) {
        return $images;
    }

}


function getUserImages()
{
    $userid = $_SESSION['id'];
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


function getImageComments($imageId)
{
    $conn = getConnection();

    $query = "SELECT * FROM comments where image_id = :imageId";
    $statement = $conn->prepare($query);
    $statement->bindParam(':imageId', $imageId);
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $comments;

}

function addImageComment($comment, $authorId, $imageId)
{


    $time = (string)strtotime("now");
    $conn = getConnection();

    $query = "INSERT INTO comments(comment, image_id, user_id, post_date) VALUES(:comment, :image_id,:user_id, now());";
    $statement = $conn->prepare($query);
    $statement->bindParam(':comment', $comment);
    $statement->bindParam(':image_id', $imageId);
    $statement->bindParam(':user_id', $authorId);
   // $statement->bindParam(':post_date', $time);
    $success = $statement->execute();

    return $success;

}

function deleteImage($imageId) {

    $imageId = (int)$imageId;
    $conn = getConnection();
    $query = "DELETE FROM images where id = :imageId;";
    $statement = $conn->prepare($query);
    $statement->bindParam(':imageId', $imageId);
    $success = $statement->execute();

    return $success;
}


function getUserName($id)
{

    $conn = getConnection();
    $query = "SELECT username FROM users WHERE id = :id;";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();

    $result = $statement->fetch();
    $username = $result['username'];


    return $username;
}

function getCurrentUser() {
    $conn = getConnection();
    $userId = $_SESSION['id'];
    $query = 'SELECT * FROM users where id =:id';
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $userId);
    $statement->execute();
    $result = $statement->fetch();
    return $result;
}

function getAllUsers() {
    $conn = getConnection();
    $query = "Select * from users";
    $statement = $conn->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll();
    return $users;

}