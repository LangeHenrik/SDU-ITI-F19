<?php

function getComments($postId){
    $result = loadImageComments($GLOBALS["conn"], $postId);
    $comments = [];

    foreach($result as $item) {
        $comment = new Comment($item["image_id"],$item["user_id"],$item["image_id"], $item["content"], $item["created_on"]);
        $comments[] = $comment;
    }
    return $comments;
}