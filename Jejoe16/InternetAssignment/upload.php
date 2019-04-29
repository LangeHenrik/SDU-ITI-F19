<?php
/**
 * Created by PhpStorm.
 * User: Jesper
 * Date: 15-03-2019
 * Time: 09:15
 */
include("database.php");

if(!empty($_POST)) {

    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    //print($target_file);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            //error
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                session_start();

                $username = $myusername = $_SESSION['login_user'];
                $imagepath = $myusername = $target_file;
                $imagename = $myusername = $_POST['imagename'];
                $comment = $myusername = $_POST['comment'];
                uploadImage($username,$imagename,$comment,$imagepath);

                header("location: index.php");
            } else {
                // error while uploading.
            }
        }
    }
}
?>
<html>
<head>
<link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <br>
    <label>Image Label</label>
    <input type="text" placeholder="Image Label" name="imagename">
    <label>Comment</label>
    <input type="text" placeholder="Image Comment" name="comment">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>


</html>
