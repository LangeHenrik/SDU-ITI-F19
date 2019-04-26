<?php
$server = 'localhost';
$username = 'root';
$password = 'root';
$dsn =  'mysql:dbname=madre10;host=localhost;port=3306;charset=utf8';
$image_folder= "uploaded_images/";
$conn = null;
try{
    $conn = new PDO($dsn, $username, $password);
    $GLOBALS["conn"] = $conn;
} catch(PDOException $e){
    die( "Connection failed: " . $e->getMessage());
}
