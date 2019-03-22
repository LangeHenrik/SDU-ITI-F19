<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 20-03-2019
 * Time: 18:27
 */
require 'db_config.php';


function checkUserExist($un){
    $conn = connect();
    $statement = $conn->prepare('select username from userdb where username = :username;');
    $statement->bindParam(':username',$un);
    $statement->setFetchmode(PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll();
    $count = count($result);
    if($count == 1 ) {
    return true;
    }else{
    return false;
    }

}

function register_to_db($username,$pass){
    $conn = connect();
    $statement = $conn->prepare('insert into userdb (username, pass) values (:username, :pass);');
    /* Bind Parameters*/
    //$hashpassword = password_hash($pass, PASSWORD_DEFAULT);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':pass', $pass);
    $statement->execute();
    $conn = null;
}

function checkpass($ausername, $apassword) {
    $conn = connect();
    $statement = $conn->prepare('select * from userdb where username = :username AND pass = :pass;');
    $statement->bindParam(':username', $ausername);
    $statement->bindParam(':pass', $apassword);
    $statement->execute();
    $result = $statement->fetchAll();
    $count = count($result);
    if($count == 1 ) {
        return true;
    }else{
        return false;
    }

}

function gallerydb() {
    $conn = connect();
    $statement = $conn->prepare('select * from imagedb;');
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}
function userdb() {
    $conn = connect();
    $statement = $conn->prepare('select username from userdb;');
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}

function upload($username,$title,$description,$path){
    $conn = connect();
    $statement = $conn->prepare('insert into imagedb (username, image, tittle, description) values (:username, :path, :title, :description);');
    $statement->bindParam(':username', $username);
    $statement->bindParam(':path', $path);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':description', $description);
    $statement->execute();
    $conn = null;
}






?>