<?php

include_once 'C:\Users\goope\Documents\GitHub\SDU-ITI-F19\jschr17\mvc\app\core\Database.php';
$database = new Database();
$conn = $database->getConn();

if(isset($_POST["submit"])){

    $newFileName = $_POST["filename"];
    if (empty($_POST["filename"])){
        $newFileName = "gallery";
    } else {
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $imageTitle = $_POST["filetitle"];
    $imageDesc = $_POST["filedesc"];

    if(!empty(htmlspecialchars($_SESSION["username"]))){
        $user_id = $_SESSION["id"];
    }

    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    $blob = addslashes(file_get_contents($_FILES[$file][$fileTempName]));

    if (in_array($fileActualExt, $allowed)){
        if ($fileError === 0){
            if ($fileSize < 200000){
                $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                $fileDestination = "images/" . $imageFullName;

                if(empty($imageTitle) || empty($imageDesc)){
                    exit();
                } else {
                    $sql = 'SELECT * FROM images;';
                    $stmt = $conn->prepare($sql);
                    if(!$stmt = $conn->prepare($sql)){
                        echo "SQL statement failed 1";
                    } else {
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        /*$rowCount = mysqli_num_rows($result);
                        $setImageOrder = $rowCount + 1;*/

                        //$stmt = mysqli_stmt_init($conn);
                        $sql2 = 'INSERT INTO images(blob, imgName, title, description, user_id) VALUES (?, ?, ?, ?);';
                        $stmt2 = $conn->prepare($sql2);
                        if(!$stmt2 = $conn->prepare($sql2)){
                            echo "SQL statement failed 2";
                        } else {
                            $stmt2->execute([$blob, $imageFullName, $imageTitle, $imageDesc, $user_id]);
                            //mysqli_stmt_execute($stmt);

                            //move_uploaded_file($fileTempName, $fileDestination);
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