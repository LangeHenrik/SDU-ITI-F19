<?php

include_once(__DIR__.'/entities/user.php');
include_once(__DIR__.'/entities/post.php');
include_once(__DIR__.'/entities/comment.php');
require_once __DIR__.'/database/database.php';


function getUserPosts($userId)
{
    $result = loadUserImages($GLOBALS["conn"], $userId);
    $posts = [];

    foreach($result as $item) {
        $post = new Post($item["id"], $item["owner"],$item["file_name"],$item["uploaded_on"],$item["title"], $item["description"]);
        $posts[] = $post;
    }
    return $posts;
}

function getAllPosts($limit)
{
    $result = loadNewImages($GLOBALS["conn"], $limit);
    $posts = [];

    foreach($result as $item) {
        $post = new Post($item["image_id"], $item["owner"], $item["file_name"],$item["uploaded_on"],$item["title"], $item["description"]);
        $posts[] = $post;
    }
    return $posts;
}

function addComment($comment){
    $user_id = $comment["user_id"];
    $image_id = $comment["image_id"];
    $content = $comment["comment"];

    putComment($GLOBALS["conn"], $user_id, $image_id, $content);

}

