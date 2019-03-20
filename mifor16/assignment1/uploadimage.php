<?php
require "dbmanager.php";

    $upload_path = "uploads/";
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
        <input type="text" placeholder="Header for Image" name="imagename">
        <label>Comment</label>
        <input type="text" placeholder="Description for Image" name="comment">
        <!--<input type="submit" value="Submit Image" name="submit">-->
        <button type="submit" value="Submit Image">Submit Image</button>
    </div>
</form>
</body>

</html>
