<?php
require_once(__DIR__ . '/../Model/commentDAO.php');
require_once(__DIR__ . '/../Model/entities/comment.php');

if(!isset($_POST['comment']) && !isset($_SESSION['user_id']) && !isset($_POST['post_id'])){
    echo "Something fudged up... Probably something related to PHP.";
    //header("Location: /");
} else {
    $user_id = $_SESSION['user_id'];
    $content = htmlentities($_POST['comment']);
    $post_id =  htmlentities($_POST['post_id']);
    $comment = new Comment(null, $user_id, $post_id, $content, "NOW()");
    addComment($comment);
    header("Location: /madre10/feed");
}