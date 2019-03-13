<?php
require 'util/logincheck.php';
require 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Images</title>
    <link rel="stylesheet" type="text/css" href="General.css">
</head>
<body>
<div class="container">
    <div id="navbar"></div>

    <div>
        <h1> Upload image </h1>
        <br/>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="my_images__form">
            Select Image File to Upload: <input type="file" name="file">
            <br/>
            <br/>
            <input type="text" name="title" placeholder="Title" />
            <br/>
            <br/>
            <textarea name="description" class="textarea" rows="4" cols="50" placeholder="Description.."></textarea>
            <br/>
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>

    <br/>
    <br/>

    <?php
    if(isset($_SESSION['user_id'])){
        $images = getUserImages($_SESSION['user_id'], $conn);
        $image_folder= "images/";


        foreach($images as $image) {
            echo '<div class="my_images__image-wrapper">';
            echo '<h2>'.$image['title'].'</h2>';
            echo '<img src="'.$image_folder.$image["file_name"].'" /><br />';
            echo '<p>'.$image['description'].'</p>';
            echo '</div>';
        }
    }

    ?>



    <script src="navbar.js"></script>
</body>
</html>