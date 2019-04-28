<?php
require 'db_config.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $GLOBALS["conn"] = $conn;
} catch(PDOException $exception) {
    die("Connection error:" . $exception->getMessage());
}