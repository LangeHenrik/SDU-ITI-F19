<?php
$server = 'localhost';
$username = 'root';
$password = 'root';
$dsn =  'mysql:dbname=internet_technology;host=localhost;port=3306;charset=utf8';
try{
    $conn = new PDO($dsn, $username, $password);
} catch(PDOException $e){
    die( "Connection failed: " . $e->getMessage());
}

function getUserImagePaths($userId, $conn) {
    $records = $conn->prepare('SELECT file_name FROM images WHERE owner = :userId');
    $records->bindParam(':userId', $userId);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
