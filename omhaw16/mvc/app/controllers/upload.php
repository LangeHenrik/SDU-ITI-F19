<!DOCTYPE html>
<html>
<head>

        <title> Upload </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/omhaw16/mvc/app/views/styling/style.css">
        <link rel="shortcut icon" type="image/png" href="/omhaw16/mvc/app/views/styling/favicon.png"/>

</head>

<body>

<h1> PhotoPost - Upload </h1>
<p class = 'tagline'> - Your photo-sharing website </p>


<?php 

    $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     
    include $pathroot . '/omhaw16/mvc/app/views/partials/navi.php';
    include $pathroot . '/omhaw16/mvc/app/views/partials/logout.php';

$imgtitle = "";
$imgdesc = "";
$imgname = "";
$postedby = "";

if(session_status() == PHP_SESSION_NONE) {
session_start();
}
$postedby = $_SESSION["userID"];

if ($_SESSION["login"] == 1) {

if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['submitimg'])) {

$imgtitle = $_POST["imgtitle"];
$imgdesc = $_POST["imgdesc"];
$imgname = basename($_FILES["fileToUpload"]["name"]);

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);
$target_dir = $pathroot . "/omhaw16/mvc/app/models/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));




// Check if image file is a actual image or fake image
if(isset($_POST["submitimg"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "<p class='guide'>File is an image - " . $check["mime"] . ". </p>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "<p class='status'> Sorry, file already exists. </p>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "<p class='status'> Sorry, your file is too large. </p>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<p class = 'status'> Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<p class = 'status'> Sorry, your file was not uploaded. </p>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<p class = 'success'> The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded. <p>";

              $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
       require $pathroot . '/omhaw16/mvc/app/core/serverconn.php';


        $sqlinsimg="INSERT INTO posts (postedby, imgName, imgTitle, imgDesc, imgDate) VALUES('$postedby','$imgname', '$imgtitle', '$imgdesc', NOW())";


 //       echo $sqlinsimg;

        if ($conn->query($sqlinsimg)) {
        //    echo " Upload to database done! ";
            $conn->close();
            } else {
                echo "DB-upload not done. " . $conn->error();
            }

     //       echo "database stuff done.";

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
} 
} else if ($_SESSION['login'] == 0) {
    echo "<p class='guide'> Please log in, before you upload. </p>";
}
?>

<p> Here you can upload any image you desire! </p>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <p class ="guide"> Select image to upload: </p>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <br>
    <label for="imgtitle">Image title</label>
    <br>
    <input type="text" name="imgtitle" id="imgtitle">
    <br>
    <br>
    <label for="imgtitle">Additional text</label>
    <br>
    <textarea name="imgdesc" id="imgdesc"> </textarea>
    <br>
    <br>
    <input type="submit" value="Upload Image" style="color: black" name="submitimg">
</form>

</body>
</html>