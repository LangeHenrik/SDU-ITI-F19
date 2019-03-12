<?php
session_start();
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
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select Image File to Upload:
            <input type="file" name="file">
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>

    <?php
    if(isset($_SESSION['user_id'])){
        $image_names = getUserImagePaths($_SESSION['user_id'], $conn);
        $image_folder= "images/";


        foreach($image_names as $image) {
            echo '<img src="'.$image_folder.$image["file_name"].'" /><br />';
        }
    }

    ?>



    <script src="navbar.js"></script>
</body>
</html>