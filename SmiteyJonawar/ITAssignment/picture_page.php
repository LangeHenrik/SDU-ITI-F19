<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 20-03-2019
 * Time: 11:08
 */

require "db_manager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            session_start();
            $username = $_SESSION['login_user'];
            $path = $target_file;
            $title = $_POST['title'];
            $description = $_POST['description'];
            upload_picture($username, $path, $title, $description);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {

}

?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <link href="stylesheet.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="row">
    <div class="column left" style="background-color:white;">
        <form action= "logout.php" method="post">
            <button class="button buttonlogout" type="submit">Logout</button>
        </form>
        <form action="picture_page.php" method="post" enctype="multipart/form-data">
            Select image to upload: <br>
            <input type="file" name="fileToUpload" id="fileToUpload"> <br> <br>
            Title of image: <br>
            <input type="text" name="title" id="titleOfImage"><br> <br>
            Description of image: <br>
            <input type="text" name="description" id="descriptionOfImage"><br> <br>
            <input type="submit" value="Upload Image" name="submit">
        </form>
        <br>
        Users (uses ajax): <br>
        <button><a id="button">Show all users</a></button>

        <p id="container"><!-- currently it's empty --></p>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('a#button').click(function(){
                    $.ajax({
                        url: 'ajax_call.php',
                        success: function (response) {
                            $('#container').html(response);
                        }
                    });
                });
            });
        </script>
    </div>
    <div class="column right" style="background-color:grey;">
        <?php
        $images = get_20_latest_images();
        for ($x = 0; $x < sizeof($images); $x++) {
            echo $images[$x]['title'].' - By: '.$images[$x]['username'];
            echo '<div class = "img">';
            echo '<img src="'.$images[$x]['path'].'"/>';
            echo '</div>';
            echo $images[$x]['description'];
            echo '<hr>';
        }
        ?>
    </div>
</div>
</body>
</html>
