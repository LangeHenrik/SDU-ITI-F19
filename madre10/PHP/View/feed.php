<?php
    require_once(__DIR__.'/../Model/model.php');
    $message = null;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feed</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<div class="container">
    <?php include(__DIR__.'/Components/NavigationBar.php'); ?>

    <div class="feed_container" id="feed_container">
        <h1> Feed </h1>
        <?php

        if($message != null) {
            echo '<div class="alert_message">'.$message.'</div>';
        }



        $posts = getAllImages(10);


        foreach ($posts as $post) {
            $image_path = $image_folder . $post->file_name;

            echo '<div class="feed__item">';
            echo '<h2>' . $post->title . '</h2>';

        }

        ?>

    </div>
</div>

</body>
</html>