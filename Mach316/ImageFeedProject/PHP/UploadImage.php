<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-11
 * Time: 10:14
 */



include 'db_config.php';
session_start();


function renameFile($target_file, $target_dir, $imageName) {
    $extension = pathinfo($target_file,PATHINFO_EXTENSION);
    return $target_dir.explode('.', $imageName)[0] . rand (1 , 10000 ) . "." . $extension;
}

function shortenFileName($target_file, $target_dir, $imageName) {
    $extension = pathinfo($target_file,PATHINFO_EXTENSION);
    $newName = substr(explode('.',$imageName)[0], 0, 90);
    return $target_dir.$newName.'.'.$extension;

}


$dbConnection = getConnection();


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["theFile"]["name"]);

$imageHeader = htmlentities($_POST['imageHeader']);
$imageText = htmlentities($_POST['imageText']);
$imageName = htmlentities(basename($_FILES['theFile']['name']));
$imageName = preg_replace('/\s+/', '', $imageName);
$userId = $_SESSION['id'];
$userName = $_SESSION['username'];

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if(isset($_POST["submit"])) {
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if(strlen($imageName) > 100) {
        $target_file = shortenFileName($target_file, $target_dir, $imageName);
    }

    // Check if file already exists
    while (file_exists($target_file)) {
        $target_file = renameFile($target_file, $target_dir, $imageName);
    }


    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["theFile"]["tmp_name"], $target_file)) {

            $target_file = (string)$target_file;

            $imageName = explode("/", $target_file)[1];
            $imageName = (string)$imageName;
            $imageHeader = (string)$imageHeader;
            $imageText = (string)$imageText;
            $userId = (int)$userId;

            $query = "INSERT INTO images(name, header, text, user_id) VALUES(:imagename,:imageheader,:imagetext,:userid)";
            $statement = $dbConnection->prepare($query);
            $statement->bindParam(':imagename', $imageName);
            $statement->bindParam(':imageheader', $imageHeader);
            $statement->bindParam(':imagetext', $imageText);
            $statement->bindParam(':userid', $userId);
            $success = $statement->execute();

            if($success) {
                header('Location: http://localhost:8000/PHP/PictureManagement.php?');
            } else {
                echo "Shit didnt work<br>";
                echo "{$imageName}"." : ".gettype($imageName)."<br>";
                echo "{$imageHeader}"." : ".gettype($imageHeader)."<br>";
                echo "{$imageText}"." : ".gettype($imageText)."<br>";
                echo "{$userId}".": ".gettype($userId)."<br>";
            }


        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


}