<?php
include_once "databaseHandler.res.php";
session_start();
if (isset($_POST['image-submit'])) {

    /*$imageTitle = $_POST['imagetitle'];
    if (empty($imageTitle)) {
        $imageTitle = "image";
    }
    else {
        $imageTitle = strtolower(str_replace(" ", "-", $imageTitle));
    }*/

    $imageTitle = $_POST['imagetitle'];
    $imageDesc = $_POST['imagedesc'];


    $image = $_FILES['image'];

    //if (isset($_POST['userId'])) $userId = $_POST['userId'];
    $userId = $_SESSION['userId'];
    echo $userId;

    $imageName = $image["name"];
    $imageType = $image["type"];
    $imageTempName = $image["tmp_name"];
    $imageError = $image["error"];
    $imageSize = $image["size"];

    $imageTempExt = explode(".", $imageName);
    $imageExt = strtolower(end($imageTempExt));

    $allowedTypes = array("jpg", "jpeg", "png");

    if (in_array($imageExt, $allowedTypes)) {
        if ($imageError === 0) {
            if ($imageSize < 5000000) {
                $imageFullName = $imageTitle . "." . uniqid("", false) . "." . $imageExt;
                $imageDestination = "gallery/" . $imageFullName;



                if (empty($imageTitle) || empty($imageDesc)) {
                    header("Location: ../index.php?upload=empty");
                    exit();
                }
                else {
                    $sql = "INSERT INTO gallery (idUsers, titleGallery, descGallery, imageNameGallery) VALUES (?, ?, ?, ?);";
                    $statement = mysqli_stmt_init($connection);
                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        echo "SQL statement failed!";
                    }
                    else {
                        mysqli_stmt_bind_param($statement, "isss", $userId, $imageTitle, $imageDesc, $imageFullName);
                        mysqli_stmt_execute($statement);

                        move_uploaded_file($imageTempName, $imageDestination);

                        header("Location: ../index.php?upload=success");
                        exit();
                    }
                }
            }
            else {
                echo "File size too big!";
                exit();
            }
        }
        else {
            echo "You had " .$imageError. " error!";
            exit();
        }
    }
    else {
        echo "You need to upload a proper file type!";
        exit();
    }

}

if (isset($_POST['image-delete'])) {
    $sql = "DELETE FROM gallery WHERE imageNameGallery=?;";
    $statement = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else {

        $imageDeleteName = $_POST['image-delete'];
        mysqli_stmt_bind_param($statement, "s", $imageDeleteName);
        mysqli_stmt_execute($statement);
        if (file_exists("gallery/".$imageDeleteName)) {
            unlink("gallery/".$imageDeleteName);
        }
        header("Location: ../portfolio.php?delete=success");
        exit();
        /*$result = mysqli_stmt_get_result($statement);
        if ($row = mysqli_fetch_assoc($result)) {
            $deleteCheck = image_verify($imageDeleteName, $row['imageNameGallery']);
            if ($deleteCheck == true) {
                header("Location: ../portfolio.php?error=deletefailed");
                exit();
            }
            else if ($deleteCheck == false) {
                header("Location: ../portfolio.php?delete=success");
                exit();
            }*/
        }
}