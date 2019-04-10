<?php
require_once(__DIR__ . '/../Model/postDAO.php');
require_once(__DIR__ . '/../Model/commentDAO.php');
require_once 'Components/PostRender.php';
$message = null;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feed</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/feed.css">;
</head>
<body>

<div class="container">
    <?php include(__DIR__ . '/Components/NavigationBar.php'); ?>

    <div class="feed_container" id="feed_container">
        <h1> Feed </h1>
        <?php

        if ($message != null) {
            echo '<div class="alert_message">' . $message . '</div>';
        }


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