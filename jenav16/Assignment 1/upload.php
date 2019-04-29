<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ITI 1.0</title>
</head>
<body>
<?php

require "db_config.php";
require "database.php";


$targetFile = $PATH . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$isImage = getimagesize($_FILES["file"]["tmp_name"]);
$fileID = rand(100000000, 999999999);
if (isset($POSTUPLOAD)) {

    $stmt = $conn->prepare("SELECT fileID FROM Assets WHERE fileID = :fileID");
    $stmt->bindParam(":fileID", $fileID);
    $stmt->execute();
    $executed = $stmt->fetchAll();

    if ($executed != null) {
        die("File already exists");
    }
    if ($isImage == true) {
        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
            && $imageFileType == "gif") {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $PATH . $fileID)) {
                $stmt = $conn->prepare("INSERT INTO Assets (username,fileID,headline,text,date) values (:username,:fileID,:headline,:text,NOW())");
                $stmt->bindParam(":username", $_SESSION['username']);
                $stmt->bindParam(":fileID", $fileID);
                $stmt->bindParam(":headline", $POSTHEADER);
                $stmt->bindParam(":text", $POSTTEXT);
                $stmt->execute();
            } else {
                die("Unable to upload");
            }
        } else {
            die($imageFileType . " is not a supported image file");
        }
    } elseif ($imageFileType == null) {
        die("No file selected");
    } else {
        die("File is not an image");
    }

    header('location: ./');
}

if (isset($POSTDELETE)) {
    if (!isloggedIn()) {
        die("Failed: you need to log in first.");
    }

    if (!isset($POSTFILEID)) {
        die("Failed: no file specified");
    }
    $statement = $conn->prepare("DELETE FROM Assets WHERE fileID = :fileID");
    $statement->bindParam(":fileID", $POSTFILEID);
    $statement->execute();

    unlink($PATH . $POSTFILEID);
    header('location: ./');
}


function isloggedIn()
{
    return isset($_SESSION['username']);
}

?>
</body>
</html>
