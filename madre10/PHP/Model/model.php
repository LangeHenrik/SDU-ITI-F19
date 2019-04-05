<?php

include_once(__DIR__.'/entities/user.php');
include_once(__DIR__.'/entities/post.php');
include_once(__DIR__.'/entities/comment.php');
require_once __DIR__."/database/database.php";


function getUserImages($userId)
{
    $result = loadUserImages($conn, $userId);
    $posts = [];

    foreach($result as $item) {
        $post = new Post($item["id"], $item["owner"],$item["file_name"],$item["uploaded_on"],$item["title"], $item["description"]);
        $posts[] = $post;
    }
    return $posts;
}

function getAllImages($limit)
{
    $result = loadNewImages($GLOBALS["conn"], $limit);
    print_r($result);
    $posts = [];

    foreach($result as $item) {
        $post = new Post($item["image_id"], $item["owner"], $item["file_name"],$item["uploaded_on"],$item["title"], $item["description"]);
        $posts[] = new Post($item["image_id"], $item["owner"], $item["file_name"],$item["uploaded_on"],$item["title"], $item["description"]);
    }
    return $posts;
}

function getImageComments($imageId){
    $result = loadImageComments($conn, $imageId);
    $comments = array();

    foreach($result as $item) {
        $comment = new Comment($item["id"],$item["user_id"],$item["image_id"], $item["content"], $item["created_on"]);
        array_push($comments,$comment);
    }
    return $comments;
}


function addComment($comment){
    $user_id = $comment["user_id"];
    $image_id = $comment["image_id"];
    $content = $comment["comment"];

    putComment($conn, $user_id, $image_id, $content);

}





