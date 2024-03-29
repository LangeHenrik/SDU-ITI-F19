<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */

function connectToDb()
{
    $username = 'root';
    $password = '';
    $dsn = 'mysql:dbname=mipou16;host=localhost;port=3306;charset=utf8';
    try {
        $conn = new PDO($dsn, $username, $password);
        return $conn;
    } catch (PDOException $e) {
        print($e->getMessage());
        die("Connection failed: " . $e->getMessage());
    }
}
function checkUser($username)
{
    $conn = connectToDb();

    $statement = $conn->prepare('SELECT * FROM Users WHERE username = :username');
    $statement->bindParam(':username', $username);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $result = $statement->fetchAll();
    $conn = null;
    return $result;
}


function registerUser($username, $password, $firstname, $lastname, $zip, $city, $email, $phone)
{


    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
    $conn = connectToDb();


    $statement = $conn->prepare('INSERT INTO Users (username, password, firstname, lastname, zip, city, email, phone) 
    VALUES (:username, :password, :firstname, :lastname, :zip, :city, :email, :phone)');


    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $passwordhash);
    $statement->bindParam(':firstname', $firstname);
    $statement->bindParam(':lastname', $lastname);
    $statement->bindParam(':zip', $zip);
    $statement->bindParam(':city', $city);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':phone', $phone);
    $statement->execute();
    return $statement;
}


function getUsername($username)
{


    $conn = connectToDb();
    $statement = $conn->prepare("SELECT username FROM Users WHERE username = :username");
    $statement->bindParam(':username', $username);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);


    $result = $statement->fetchAll();
    if (count($result) !== 0) {
        $data = $result[0];
        $conn = null;

        return ($data['username']);
    } else {

        $conn = null;
        return "";
    }
}
function getDetailsFromID($id)
{


    $conn = connectToDb();

    $statement = $conn->prepare("SELECT * FROM images WHERE userid = :uuid");
    $statement->bindParam(':uuid', $id);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();
    $conn = null;

    return $result;
}
function uploadImage($username, $headertext, $commenttext, $imagename)

{


    $conn = connectToDb();


    $statement = $conn->prepare("SELECT uuid FROM Users WHERE username = :username");
    $statement->bindParam(':username', $username);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $result = $statement->fetchAll();
    $data = $result[0];
    $userid = ($data['uuid']);
    $statement = $conn->prepare("INSERT INTO images (userid, imagepath, headertext, imagetext) 
    VALUES (:userid, :imagepath, :headertext, :imagetext)");


    $statement->bindParam(':userid', $userid);
    $statement->bindParam(':imagepath', $imagename);
    $statement->bindParam(':headertext', $headertext);
    $statement->bindParam(':imagetext', $commenttext);
    $statement->execute();


    return $statement;
}


function getallusers()
{


    $conn = connectToDb();
    $statement = $conn->prepare("SELECT * FROM Users");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $result = $statement->fetchAll();
    $conn = null;
    return $result;

}


function getallimages()
{


    $conn = connectToDb();
    $statement = $conn->prepare("SELECT * FROM images");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);


    $result = $statement->fetchAll();
    $conn = null;

    return $result;
}
function toggleLike($image)
{

    $conn = connectToDb();

    $statement = $conn->prepare("SELECT * FROM images WHERE imagepath = :image");

    $statement->bindParam(':image', $image);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $result = $statement->fetchAll();
    $data = $result[0];

    $imagelikeS = ($data['likeS']);
    if ($imagelikeS == 0) {
        $imagelikeS = 1;
    } else {
        $imagelikeS = 0;
    }

    $statement = $conn->prepare("UPDATE images SET likeS = :imagelikeS WHERE imagepath = :image");

    $statement->bindParam(':imagelikeS', $imagelikeS);
    $statement->bindParam(':image', $image);
    $statement->execute();

    $conn = null;
}
?>