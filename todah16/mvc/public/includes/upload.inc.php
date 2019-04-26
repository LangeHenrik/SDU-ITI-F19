<?php

session_start();

require 'dbh.inc.php';


if(isset($_POST['upload'])){    
$image_description =$_POST['description'];

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$test = basename( $_FILES["fileToUpload"]["name"]);

if($test == null){
    header("Location: ../index.php");
} else {
    
    
    
$user_name = $_SESSION['user_name'];

    

if(writeToImageDB($test, $image_description, $user_name ,$conn) && uploadImage($target_dir, $target_file, $imageFileType)){  
    header("Location: ../index.php");
    exit();
}

    
   
}
} else {
    
}


function writeToImageDB($title, $description, $user_name ,$conn){
   
    $sql_insert = "INSERT INTO `images` (`name`, `description`, `user_name`) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql_insert)){
        echo "There was a unexpected error.";
        return false;
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $title, $description, $user_name);
        mysqli_stmt_execute($stmt);
        return true;   
}
}


function uploadImage($target_dir, $target_file, $imageFileType) {
$uploadOk = 1;
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
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else if (strpos($target_file, 'dank') == false) {
    echo "<p style='color:green;'>Image must be dank!</p>";
    echo 'Please try again with an image with dank in the name';
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    return true;
    
        /* header("Location: ../Dankify_feed.php");
        exit();
        */
    
    
    
}