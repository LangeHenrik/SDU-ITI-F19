<?php
$server = 'localhost';
$username = 'root';
$password = 'root';
$dsn =  'mysql:dbname=internet_technology;host=localhost;port=3306;charset=utf8';
$image_folder= "images/";
try{
    $conn = new PDO($dsn, $username, $password);
} catch(PDOException $e){
    die( "Connection failed: " . $e->getMessage());
}

function getUserImages($userId, $conn) {
    $records = $conn->prepare('SELECT file_name, title, description FROM images WHERE owner = :userId');
    $records->bindParam(':userId', $userId);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}


function getFeedImages($conn,$number_of_items){
    $records = $conn->prepare('SELECT images.id as image_id, file_name, title, description, owner, username, uploaded_on FROM images join users on images.owner=users.id ORDER BY uploaded_on DESC');
    #$records->bindParam(':limit', $number_of_items);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function getImageComments($conn, $imageId) {
    $records = $conn->prepare('SELECT user_id, image_id, content, created_on, username FROM comments JOIN users ON comments.user_id = users.id WHERE image_id = :image_id ORDER BY created_on ASC ');
    $records->bindParam(':image_id', $imageId);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function addComment($conn, $userId, $image_id, $comment){
    $statement = $conn->prepare('INSERT INTO comments (user_id, image_id, content, created_on ) VALUES (:user_id, :image_id, :content, NOW())');
    $statement->bindParam(':user_id', $userId);
    $statement->bindParam(':image_id', $image_id);
    $statement->bindParam(':content', $comment);
    $statement->execute();
}