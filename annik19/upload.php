<?php
include "Images.php";
require_once "config.php";

$title = htmlentities($_POST["img_title"]);
$text = htmlentities($_POST["img_text"]);
$user = $_SESSION["user"];
$find_user_id = 'select id from '.'user'. ' where username="'. $user.'";';
$stmt = $conn -> prepare($find_user_id);
$stmt -> execute();
$result = $stmt -> fetch(PDO::FETCH_ASSOC);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    $new_img = 'INSERT INTO myimages (header, text, id_user, image) VALUES (:header, :text, :id_user, :img);';
    $stmt = $conn->prepare($new_img);
    $stmt -> bindParam(":header", $title);
    $stmt -> bindParam(":text", $text);
    $stmt -> bindParam(":id_user", $result['id']);
    $stmt -> bindParam(":img", $target_file);
    $stmt -> execute(); ?>
<?php } else {
    //echo "Sorry, there was an error uploading your file.";
}
header("Location: Images.php?");