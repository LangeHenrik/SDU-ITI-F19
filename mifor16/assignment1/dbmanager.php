<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-03-19
 * Time: 18:08
 */
require 'db_config.php';


function getUsers (){
    $conn = getConnection();
    $statement = $conn->prepare("SELECT * FROM Users");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $result = $statement->fetchAll();
    $conn = null;
    return $result;
}

function checkUserExists($ausername) {
    $conn = getConnection();
    $statement = $conn->prepare('select username from users where username = :username;');
    $statement->bindParam(':username', $ausername);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll();

    $count = count($result);
    if ($count >= 1) {
        return true;
    } else {
        return false;
    }
    $conn = null;
}

function registerUser($username, $password, $firstname, $lastname, $city, $zip, $mail, $phone) {
    $conn = getConnection();
    $statement = $conn->prepare('insert into users (username, password, first, last, zip, city, mail, phone) values (:username, :password, :first, :last, :zip, :city, :mail, :phone);');

    $hashpassword = password_hash($password, PASSWORD_DEFAULT);

    /* Bind Parameters*/
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $hashpassword);

    $statement->bindParam(':first', $firstname);
    $statement->bindParam(':last', $lastname);

    $statement->bindParam(':zip', $zip);
    $statement->bindParam(':city', $city);

    $statement->bindParam(':mail', $mail);
    $statement->bindParam(':phone', $phone);

    $statement->execute();
    $conn = null;
}