<?php

include_once(__DIR__.'/entities/user.php');
include_once(__DIR__.'/entities/post.php');
include_once(__DIR__.'/entities/comment.php');
require_once __DIR__."/database/database.php";


function getUserImages($userId)
{
    $result = loadUserImages($GLOBALS["conn"], $userId);
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
    $posts = [];

    foreach($result as $item) {
        $post = new Post($item["image_id"], $item["owner"], $item["file_name"],$item["uploaded_on"],$item["title"], $item["description"]);
        $posts[] = $post;
    }
    return $posts;
}

function getImageComments($imageId){
    $result = loadImageComments($GLOBALS["conn"], $imageId);
    $comments = array();

    foreach($result as $item) {
        $comment = new Comment($item["id"],$item["user_id"],$item["image_id"], $item["content"], $item["created_on"]);
        array_push($comments,$comment);
    }
    return $comments;
}







