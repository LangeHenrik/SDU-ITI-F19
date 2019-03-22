<?php

if(isset($_POST["submit"])){

    $newFileName = $_POST["filename"];
    if (empty($_POST["filename"])){
        $newFileName = "gallery";
    } else {
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $imageTitle = $_POST["filetitle"];
    $imageDesc = $_POST["filedesc"];

    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    if (in_array($fileActualExt, $allowed)){
        if ($fileError === 0){
            if ($fileSize < 200000){
                $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                $fileDestination = "images/" . $imageFullName;

                include 'config.php';

                if(empty($imageTitle) || empty($imageDesc)){
                    exit();
                } else {
                    $sql = 'SELECT * FROM images;';
                    $stmt = mysqli_stmt_init($link3);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL statement failed 1";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOrder = $rowCount + 1;

                        $stmt = mysqli_stmt_init($link3);
                        $sql = 'INSERT INTO images(title, imgdesc, imgName, imgorder) VALUES (?, ?, ?, ?);';
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL statement failed 2";
                        } else {
                            mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName, $fileDestination);
                        }
                    }
                }
            } else {
                header("Location: welcome.php?file_too_big");
                exit();
            }
        } else {
            header("Location: welcome.php?error_uploading");
            exit();
        }
    } else {
        header("Location: welcome.php?wrong_file_type");
        exit();
    }
}
header('Location: welcome.php');
?>