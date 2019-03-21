<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 20-03-2019
 * Time: 11:35
 */
require 'db_config.php';


function login($username, $password){
    if(check_if_user_exist($username)) {
        $conn = getConnection();
        $statement = $conn->prepare('SELECT password FROM users where username = :username');
        $statement->bindParam(':username', $username);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        $conn = null;
        $hashed_password = $result[0]["password"];
        if (password_verify($password, $hashed_password) == 1) {
            return true;
        }
    }
    return false;
}

function create_user($username, $password, $firstname, $lastname, $zip, $city, $email, $phonenumber){
    if(check_if_user_exist($username)){
        return true;
    } else {
        $conn = getConnection();
        $statement = $conn->prepare('insert into users (username, password, firstname, lastname, zip, city, email, phonenumber) values (:username, :password, :firstname, :lastname, :zip, :city, :email, :phonenumber);');

        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $hashpassword);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':zip', $zip);
        $statement->bindParam(':city', $city);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':phonenumber', $phonenumber);

        $statement->execute();
        $conn = null;
        return false;
    }
}

function check_if_user_exist($username){
    $conn = getConnection();
    $statement = $conn->prepare('SELECT *, count(*) as NUM FROM users where username = :username');
    $statement->bindParam(':username', $username);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll();
    $conn = null;
    if ($result[0]["NUM"] > 0){
        return true;
    } else {
        return false;
    }
}

function upload_picture($username, $path, $title, $description){
    $conn = getConnection();
    $statement = $conn->prepare('insert into images (username, path, title, description) values (:username, :path, :title, :description);');
    $statement->bindParam(':username', $username);
    $statement->bindParam(':path', $path);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':description', $description);

    $statement->execute();
    $conn = null;
}

function get_20_latest_images(){
    $conn = getConnection();
    $statement = $conn->prepare('SELECT * FROM images ORDER BY id DESC LIMIT 20');
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll();
    $conn = null;
    return $result;
}

function really_good_ajax(){
    $conn = getConnection();
    $statement = $conn->prepare('SELECT username FROM users');
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll();
    $conn = null;
    return $result;
}