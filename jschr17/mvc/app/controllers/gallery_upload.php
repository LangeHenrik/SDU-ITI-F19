<?php

include_once ('C:\Users\goope\Documents\GitHub\SDU-ITI-F19\jschr17\mvc\app\core\Database.php');
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

    $user_id = '';

    if(!empty(htmlspecialchars($_SESSION["username"]))){
        $sql = "SELECT user_id FROM users WHERE username = :param_username";

        $stmt3 = $conn->prepare($sql);
        $stmt3->bindParam(':param_username', $param_username);
        $param_username = $_SESSION["username"];

        if ($stmt3->execute()){
            while($row = $stmt3->fetchAll(PDO::FETCH_ASSOC)){
                foreach ($row as $data_value){
                    $user_id = $data_value['user_id'];
                }
            }
        }
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

    $blob = file_get_contents($_FILES['file']['tmp_name']);
    //$blob = base64_encode($blob);

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
                        $sql2 = 'INSERT INTO images(image, imgName, title, description, user_id) VALUES (?, ?, ?, ?, ?);';
                        $stmt2 = $conn->prepare($sql2);
                        if(!$stmt2 = $conn->prepare($sql2)){
                            echo "SQL statement failed 2";
                        } else {
                            $stmt2->execute([$blob, $imageFullName, $imageTitle, $imageDesc, $user_id]);
                        }
                    }
                }
            } else {
                echo 'file too big';
                exit();
            }
        } else {
            echo 'error uploading';
            exit();
        }
    } else {
        echo 'wrong file type';
        exit();
    }
}
header('Location: welcome');
?>