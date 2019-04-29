<?php
require_once "config.php";

$image_file = $_POST["image_path"];
$sql_delete = "DELETE FROM myimages WHERE image=:image_file;";
$stmt = $conn-> prepare($sql_delete);
$stmt -> bindParam(":image_file", $image_file);
$stmt -> execute();
// echo $sql_delete ."<br>";

if ($stmt->rowCount() == 1) {
    // deleted file
    unlink($image_file);
    echo "OK";
}

header("location: images.php?");
