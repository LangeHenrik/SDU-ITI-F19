<?php
require(__DIR__.'/../../../dbConfig.php');

$conn = null;
try{
    $conn = new PDO($dsn, $username, $password);
    $GLOBALS["conn"] = $conn;
} catch(PDOException $e){
    die( "Connection failed: " . $e->getMessage());
}
