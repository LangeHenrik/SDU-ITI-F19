<?php

function getComments($postId){
    $sql = 'SELECT comments.user_id, image_id, content, created_on, username FROM comments JOIN users ON comments.user_id = users.user_id WHERE image_id = :image_id ORDER BY created_on ASC ';
    $records = $GLOBALS["conn"]->prepare($sql);
    $records->bindParam(':image_id', $postId);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    $comments = [];

    foreach($results as $item) {
        $comment = new Comment($item["image_id"],$item["user_id"],$item["image_id"], $item["content"], $item["created_on"], $item['username']);
        $comments[] = $comment;
    }
    return $comments;
}

function addComment($comment){
    $sql = 'INSERT INTO comments (user_id, image_id, content, created_on ) VALUES (:user_id, :image_id, :content, NOW())';
    $statement = $GLOBALS["conn"]->prepare($sql);
    $statement->bindParam(':user_id', $comment->user_id);
    $statement->bindParam(':image_id', $comment->image_id);
    $statement->bindParam(':content', $comment->content);
    $success = $statement->execute();
    return $success;
}