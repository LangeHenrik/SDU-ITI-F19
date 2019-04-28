<?php
$servername = "localhost";
$username = "root";
$password = "2147";
$dbname = "mipou16";

$conn = new PDO("mysql:host=$hostname; dbname=$db",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if (!$conn) {
    die('Could not connect');
}
