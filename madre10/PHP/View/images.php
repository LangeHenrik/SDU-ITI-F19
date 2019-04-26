<?php
require_once(__DIR__ . '/Components/PostRender.php');
require_once(__DIR__ . '/../Model/postDAO.php');
require_once(__DIR__ . './Components/RequireLogin.php');

$message = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Images</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/feed.css">
</head>
<body>

<div class="container">
    <?php include(__DIR__ . '/Components/NavigationBar.php'); ?>

    <?php if ($message != null) {
        echo $message;
    } ?>

    <h2>Upload new image </h2>
    <form method="post" action="/upload" enctype="multipart/form-data">

        <label> Select a file: </label>
        <input name="image" type="file"/><input type="submit" value="submit">
        <br>
        <br>
        <label>Title of image</label>
        <input name="title" type="text">
        <br>
        <br>
        <label>Description</label>
        <br>
        <textarea name="description"></textarea>

    </form>


    <h2> Your images </h2>
    <div class="feed_container">
        <?php
        $posts = getUserPosts($_SESSION['user_id']);
        foreach ($posts as $post) {
            echo renderFuckingPost($post);
        }
        ?>
    </div>
</div>

</body>
</html>