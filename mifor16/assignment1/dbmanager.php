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

function checkCredentials($ausername, $apassword) {

    $conn = getConnection();
    $statement = $conn->prepare('select username, password from users where username = :username');



    $statement->bindParam(':username', $ausername);


    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll();

    $collectedusername = $result[0]["username"];
    $collectedpassword = $result[0]["password"];
    $unhashpw = password_verify($apassword, $collectedpassword);

    if($ausername == $collectedusername && $unhashpw == 1) {
        return true;
    } else {
        return false;
    }

    $conn = null;

}

function uploadImage($username, $path, $title, $description) {
    $conn = getConnection();
    $statement = $conn->prepare('insert into images (username, path, title, description) values (:username, :path, :title, :description);');

    $statement->bindParam(':username', $username);
    $statement->bindParam(':path', $path);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':description', $description);

    $statement->execute();


    $conn = null;

}

function getImages() {
    $conn = getConnection();
    $statement = $conn->prepare('select * from images order by counter DESC LIMIT 20');

    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->execute();
    $result = $statement->fetchAll();
    $conn = null;



    return $result;
}
