<?php
require 'util/logincheck.php';
require 'database.php';

$message = null;
if (isset($_POST["submit"])){
    $user_id = $_SESSION['user_id'];
    $comment_content = htmlentities($_POST['comment_content']);
    $image_id = $_POST['image_id'];
    addComment($conn, $user_id, $image_id, $comment_content);
    $message = "Comment added.. Or at least it should be.";

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="General.css">
</head>
<body>

<div class="container">
    <div id="navbar"></div>

    <div class="feed_container" id="feed_container">
        <h1> Feed </h1>
        <?php

        if($message != null) {
            echo '<div class="alert_message">'.$message.'</div>';
        }


        $image_data = getFeedImages($conn, 100);
        foreach ($image_data as $image) {
            $image_path = $image_folder . $image['file_name'];
            $title = $image['title'];
            $description = $image['description'];
            $image_username = $image['username'];
            $image_id = $image['image_id'];

            echo '<div class="feed__item">';
            echo '<h2>' . $title . '</h2>';
            echo '<image class="feed__image" src="' . $image_path . '"></image>';
            echo '<div class="feed__caption"><p>' . $description . '</p></div>';
            echo '<div class="feed_comments">';

            $comment_data = getImageComments($conn, $image_id);
            foreach ($comment_data as $comment) {
                echo '<div class="feed__comment">';
                echo '<div class="feed__comment_author">' . $comment['username'] . '</div>';
                echo '<div class="feed__comment_content">' . $comment['content'] . '</div>';

                echo '</div>';
            }

            echo '<div class="feed__comment_input">' .
                    '<form action="index.php" method="POST">'.
                    '<textarea name="comment_content" class="feed__comment_input_textarea" rows="4" cols="50" placeholder="Comments..."></textarea>' .
                    '<br/>' .
                    '<button  name="submit" type="submit" class="feed__comment_submit_button">Submit</button>' .
                    '<input type="hidden" name="image_id" value="'.$image_id.'"/>'.
                    '</form>'.
                '</div>';

            echo '</div>';
            echo '</div>';


        }

        ?>

    </div>
</div>


<script src="navbar.js"></script>
</body>
</html>