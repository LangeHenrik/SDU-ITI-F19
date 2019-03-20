<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-03-19
 * Time: 18:08
 */
include 'db_config.php';


function getUsers (){
    $conn = getConnection();
    $statement = $conn->prepare("SELECT * FROM Users");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $result = $statement->fetchAll();
    $conn = null;
    return $result;
}