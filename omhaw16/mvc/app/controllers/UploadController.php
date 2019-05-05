<?php 

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);    

include dirname(__DIR__) . '/views/partials/navi.php';
include dirname(__DIR__) . '/views/partials/logout.php';

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
    echo "<p class = 'status'> Sorry, your file was not uploaded. UploadOK = 0 by mistake. </p>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<p class = 'success'> The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded. <p>";

              $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
       require $pathroot . '/omhaw16/mvc/app/core/serverconn.php';
       // echo $sqlinsimg;
        $sqlinsimg="INSERT INTO posts (postedby, imgName, imgTitle, imgDesc, imgDate) VALUES('$postedby','$imgname', '$imgtitle', '$imgdesc', NOW())";
        // echo $sqlinsimg;


 //       echo $sqlinsimg;

        if ($conn->query($sqlinsimg)) {
        //    echo " Upload to database done! ";
            $conn->close();
            } else {
                echo "DB-upload not done. " . $conn->error();
            }

     //       echo "database stuff done.";

    } else {
        // echo $_FILES["fileToUpload"];
        echo "<p class='guide'> Target file: " . $target_file;
        echo $_FILES["tmp_name"];
        echo "Sorry, there was an error uploading your file.";
    }
}
} 
} else if ($_SESSION['login'] == 0) {
    echo "<p class='guide'> Please log in, before you upload. </p>";
}
?>