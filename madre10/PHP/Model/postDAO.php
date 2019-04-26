<?php

include_once(__DIR__ . '/entities/user.php');
include_once(__DIR__ . '/entities/post.php');
include_once(__DIR__ . '/entities/comment.php');
require_once __DIR__ . '/database/database.php';


function getUserPosts($userId)
{
    $sql = 'SELECT images.id as image_id, file_name, title, description, owner, username, uploaded_on, image FROM images join users on images.owner=users.user_id WHERE owner=:userId';
    $records = $GLOBALS["conn"]->prepare($sql);
    $records->bindParam(':userId', $userId);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    $posts = [];

    foreach ($results as $item) {
        $post = new Post($item["image_id"], $item["owner"], $item["file_name"], $item["uploaded_on"], $item["title"], $item["description"], $item['image']);
        $posts[] = $post;
    }
    return $posts;
}


function getUserImagesSimple($userId){
    $sql = 'SELECT title, description, image FROM images WHERE owner=:userId';
    $records = $GLOBALS["conn"]->prepare($sql);
    $records->bindParam(':userId', $userId);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    return $results;

}

function getAllPosts($limit)
{
    $sql = 'SELECT images.id as image_id, file_name, title, description, owner, username, uploaded_on, image FROM images join users on images.owner=users.user_id ORDER BY uploaded_on DESC';
    $records = $GLOBALS["conn"]->prepare($sql);
    #$records->bindParam(':limit', $number_of_items);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    $posts = [];
    foreach ($results as $item) {
        $post = new Post($item["image_id"], $item["owner"], $item["file_name"], $item["uploaded_on"], $item["title"], $item["description"], $item['image']);
        $posts[] = $post;
    }
    return $posts;
}

function addPost($title, $description, $base64image, $userId)
{
    try {
        $sql = 'INSERT INTO images(owner, title, description, image, uploaded_on) VALUES (:owner, :title, :description, :image, NOW())';
        $conn = $GLOBALS["conn"];
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':owner', $userId);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $base64image);
        $success = $stmt->execute();
        $id = $conn->lastInsertId();
        //print_r($stmt->errorInfo());
        return $id;
    } catch (Exception $e) {
        //print_r($e);
        Die('Need to handle this error. $e has all the details');
    }



}

