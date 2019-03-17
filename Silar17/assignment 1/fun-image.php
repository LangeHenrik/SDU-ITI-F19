<?php
session_start();
require_once 'db_config.php';

try {

$sql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    
$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql_code = "SELECT picture, picture_type FROM silar17.picture WHERE picture_id = ?";
$stmt = $sql->prepare($sql_code);
$stmt->bindParam(1, $_GET['picture_id']);
$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);

$array = $stmt->fetch();

if(!empty($array)) {

header("Content-type: ".$array['picture_type']);
echo $array['picture'];
} else {
$filename = "images/nopic.jpg";
$picture = fopen($filename, "rb");
$contents = fread($picture, filesize($filename));
fclose($picture);
 
header("content-type: image/jpeg");
 
echo $contents;

}
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
?>
