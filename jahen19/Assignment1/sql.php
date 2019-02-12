<?php
$db_server = "db";
$db_user = "foobar";
$db_pass = "foobar123";
$db_name = "assignment1";

try {
    $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_pass);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully;<br>";

    // create new database
    $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
    $conn->exec($sql);
    // echo "Datbase successfully created;<br>";

    // create table 'Users'
    $sql = "CREATE TABLE IF NOT EXISTS Users (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL
    )";
    $conn->exec($sql);
    // echo "Table 'Users' created successfully;<br>";

    // create table 'Images'
    $sql = "CREATE TABLE IF NOT EXISTS Images (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    imagepath VARCHAR(30) NOT NULL,
    user VARCHAR(30) NOT NULL,
    header VARCHAR(50),
    text LONGTEXT
    )";
    $conn->exec($sql);
    //echo "Table 'Images' created successfully;<br>";

} catch(PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
