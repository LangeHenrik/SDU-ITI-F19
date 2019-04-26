<?php
require_once(__DIR__ . '/../Model/postDAO.php');
require_once(__DIR__ . '/../Model/commentDAO.php');
require_once 'Components/PostRender.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feed</title>
    <link rel="stylesheet" type="text/css" href="/madre10/CSS/main.css">
    <link rel="stylesheet" type="text/css" href="/madre10/CSS/feed.css">
</head>
<body>

<div class="container">
    <?php include(__DIR__ . '/Components/NavigationBar.php'); ?>

    <div class="feed_container" id="feed_container">
        <h1> Feed </h1>
        <?php

        $posts = getAllPosts(10);

        foreach ($posts as $post) {
            $comments = getComments($post->id);
            echo renderFuckingPostWithComments($post, $comments);
        }
        ?>

    </div>
</div>


</body>
</html>