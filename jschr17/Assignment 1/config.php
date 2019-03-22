<?php
define('DB_SERVER', 'remotemysql.com');
define('DB_USERNAME', 'C0rPbGHnaQ');
define('DB_PASSWORD', 'eVWCKmg32b');
define('DB_NAME', 'C0rPbGHnaQ');

$link = new PDO('mysql:host=remotemysql.com;dbname=C0rPbGHnaQ', DB_USERNAME, DB_PASSWORD);
$link2 = new PDO('mysql:host=remotemysql.com;dbname=C0rPbGHnaQ', DB_USERNAME, DB_PASSWORD);

$link3 = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$link4 = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link3 === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if($link4 === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>