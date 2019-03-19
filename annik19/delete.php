<?php
require_once "config.php";

// print_r($_POST);
unlink($_POST["image_path"]);
$sql_delete = 'DELETE FROM myimages WHERE image="' . $_POST["image_path"] .'";';
$stmt = $conn-> prepare($sql_delete);
$stmt -> execute();
// echo $sql_delete ."<br>";

header("location: Images.php?");