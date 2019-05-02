<?php
require_once "db_config.php";

$file_path = $_POST["file_path"];
$file_id = $_POST["file_id"];

if(file_exists($file_path)){
	unlink($file_path);

	$sql = "DELETE FROM pictures WHERE img_id = :img_id;";
	$stmt = $conn -> prepare($sql);
	$stmt -> bindParam(":img_id", $file_id);
	$stmt -> execute();

	header("location: profile.php");

}else{
	header("location: profile.php");
}
