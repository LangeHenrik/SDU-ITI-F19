<?php
$hostname = 'localhost';
$username = 'root';
$password = '13579sgamn';
$db = 'ImagesTable';

$conn = new PDO("mysql:host=$hostname; dbname=$db",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if (!$conn) {
    die('Could not connect');
}
// echo 'Connected successfully' . "<br>";


