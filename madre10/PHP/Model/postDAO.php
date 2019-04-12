<?php

include_once(__DIR__.'/entities/user.php');
include_once(__DIR__.'/entities/post.php');
include_once(__DIR__.'/entities/comment.php');
require_once __DIR__.'/database/database.php';


function getUserPosts($userId)
{
    $sql = 'SELECT images.id as image_id, file_name, title, description, owner, username, uploaded_on FROM images join users on images.owner=users.id WHERE owner=:userId';
    $records = $GLOBALS["conn"]->prepare($sql);
    $records->bindParam(':userId', $userId);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    $posts = [];

    foreach($results as $item) {
        $post = new Post($item["image_id"], $item["owner"],$item["file_name"],$item["uploaded_on"],$item["title"], $item["description"]);
        $posts[] = $post;
    }
    return $posts;
}

function getAllPosts($limit)
{
    $sql = 'SELECT images.id as image_id, file_name, title, description, owner, username, uploaded_on FROM images join users on images.owner=users.id ORDER BY uploaded_on DESC';
    $records = $GLOBALS["conn"]->prepare($sql);
    #$records->bindParam(':limit', $number_of_items);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    $posts = [];
    foreach($results as $item) {
        $post = new Post($item["image_id"], $item["owner"], $item["file_name"],$item["uploaded_on"],$item["title"], $item["description"]);
        $posts[] = $post;
    }
    return $posts;
}


