<?php
/**
 * DISCLAIMER:
 * The following w3schools guide was used as reference:
 * https://www.w3schools.com/php/php_file_upload.asp
 */
require "dbmanager.php";

if (!empty($_POST)) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")</script>';
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script>alert("An error occurred.")</script>';
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            session_start();

            $username = $_SESSION['login_user'];
            $path = $target_file;
            $title = $_POST['title'];
            $description = $_POST['description'];


            uploadImage($username, $path, $title, $description);

            header('location: index.php');
        } else {
            echo '<script>alert("An error occured.")</script>';
        }
    }
}
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Upload Images</title>
    <link href="mystylesheet.css" type="text/css" rel="stylesheet">
</head>

<body>
<h1>Upload Image</h1>
<nav id="nav">
    <a href="index.php">INDEX</a>
    <a href="users.php">USERS</a>
    <a href="uploadimage.php">UPLOAD</a>
    <a href="logout.php">LOGOUT</a>
</nav>
<br><br><br>

<form action="uploadimage.php" method="post" enctype="multipart/form-data">
    <div class="box">
        Select image to upload:<br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>
        <br>
        <label>Image Label</label>
        <input type="text" placeholder="Title for Image" name="title">
        <label>Comment</label>
        <input type="text" placeholder="Description for Image" name="description">
        <input type="submit" value="Begin upload" name="submit">
        <!--<button type="submit" value="Submit Image">Submit Image</button>-->
    </div>
</form>
</body>

</html>
