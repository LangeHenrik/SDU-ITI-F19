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
    $target_dir = $pathroot . "/mschm16/mvc/app/assets/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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

    if (file_exists($target_file)) {
        echo "<p class='status'> Sorry, file already exists. </p>";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "<p class='status'> Sorry, your file is too large. </p>";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "<p class = 'status'> Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<p class = 'status'> Sorry, your file was not uploaded. UploadOK = 0 by mistake. </p>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<p class = 'success'> The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded. <p>";

            $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
            require $pathroot . '/mschm16/mvc/app/core/serverconn.php';
            $sqlinsimg="INSERT INTO posts (fk_userId, postImg, postName, postText) VALUES('$postedby','$imgname', '$imgtitle', '$imgdesc')";
        
            if ($conn->query($sqlinsimg)) {
                $conn->close();
            } else {
                echo "DB-upload not done. " . $conn->error();
            }

        } else {
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