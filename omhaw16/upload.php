<!DOCTYPE html>
<html>
<head> <title> Post a photo! </title> </head>

<body>

<?php 

include 'logout.php';

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

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));




// Check if image file is a actual image or fake image
if(isset($_POST["submitimg"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
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
        echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";

        require 'serverconn.php';

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
    echo "Please log in, before you upload.";
}
?>

<h1> Upload picture </h1>

<p> Here you can upload any image you desire! </p>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
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
    <input type="submit" value="Upload Image" name="submitimg">
</form>

</body>
</html>