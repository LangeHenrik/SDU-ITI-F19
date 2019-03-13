<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-12
 * Time: 18:50
 */

include 'db_config.php';
session_start();



function getAllImages()
{
    $conn = getConnection();

    $query = "SELECT * FROM images;";
    $statement = $conn->prepare($query);
    $statement->execute();
    $images = $statement->fetchAll(PDO::FETCH_ASSOC);
    if($images != null) {
        return $images;
    }

}

function getImageComments($int)
{
    return "<p>comment for {$int}</p>";
}

function getUserImages()
{
    $userid = $_SESSION['id'];
    $conn = getConnection();

    $query = "SELECT * FROM images where user_id = :userid";
    $statement = $conn->prepare($query);
    $statement->bindParam(':userid', $userid);
    $statement->execute();
    $images = $statement->fetchAll(PDO::FETCH_ASSOC);
    if($images != null) {
        return $images;
    }
}

function getUserName($id) {

    print_r($id."\n");


    $conn = getConnection();
    $query = "SELECT username FROM users WHERE id = :id;";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();

    $result = $statement->fetch();
    $username = $result['username'];



    return $username;
}