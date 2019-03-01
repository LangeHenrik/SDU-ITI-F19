
<?php
$server = 'localhost';
$username = 'root';
$password = 'root';
$database = 'my_db';
$dsn =  'mysql:dbname=my_db;host=localhost;port=3306;charset=utf8';

try{
    $conn = new PDO($dsn, $username, $password);
} catch(PDOException $e){
    die( "Connection failed: " . $e->getMessage());
}