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
    $conn = null;
    return $result;

}