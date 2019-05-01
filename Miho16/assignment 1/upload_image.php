<?php
/**
* Created by PhpStorm.
* User: micha
* Date: 21-03-2019
* Time: 16:38
*/
session_start();
$title = $_POST['title'];
$description = $_POST['description'];
$_SESSION['title'] = $title;
$_SESSION['description'] = $description;
echo"welcome to the gallery " .$_SESSION['username'];


?>

<html>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">

    <br>
    <label>tittle:</label>
    <input type="text" placeholder="title" name="title" id = "title">
    <br>
    <label>description:</label>
    <input type="text" placeholder="description" name="description" id = "description">
</form>

</body>
</html>
