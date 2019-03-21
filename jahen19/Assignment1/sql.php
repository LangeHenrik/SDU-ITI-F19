<?php

require "config.php";

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
    username VARCHAR(31) NOT NULL,
    password VARCHAR(128) NOT NULL,
    firstname VARCHAR(128) NOT NULL,
    lastname VARCHAR(128) NOT NULL,
    zipcode VARCHAR(10) NOT NULL,
    city VARCHAR(128) NOT NULL,
    email VARCHAR(128) NOT NULL,
    phone VARCHAR(128) NOT NULL
    )";
    $conn->exec($sql);
    // echo "Table 'Users' created successfully;<br>";

    // create table 'Images'
    $sql = "CREATE TABLE IF NOT EXISTS Images (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(30) NOT NULL,
    user VARCHAR(31) NOT NULL,
    header VARCHAR(50),
    text LONGTEXT,
    date DATETIME
    )";
    $conn->exec($sql);
    //echo "Table 'Images' created successfully;<br>";

} catch(PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
