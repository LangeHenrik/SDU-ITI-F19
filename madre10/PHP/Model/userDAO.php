<?php

include_once(__DIR__ . '/entities/user.php');
require_once __DIR__ . '/database/database.php';


function getUserByUsername($username)
{
    $records = $GLOBALS['conn']->prepare('SELECT * FROM users WHERE username = :username');
    $records->bindParam(':username', $username);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    return $results;
}


function getUserById($id)
{
    $records = $GLOBALS['conn']->prepare('SELECT * FROM users WHERE id = :id');
    $records->bindParam(':id', $id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    return $results;
}


function getAllUsers()
{
    $records = $GLOBALS['conn']->prepare('SELECT * FROM users');
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    $users = createListOfUsersObjects($results);
    return $users;
}


function createUser($user)
{
    $sql = "INSERT INTO users(username, password, firstname, lastname, zip, city, email, phone) VALUES (:username, :password, :firstname, :lastname, :zip, :city, :email, :phone)";
    $stmt = $GLOBALS['conn']->prepare($sql);
    foreach (array_keys($user) as $field) {
        if ($field !== 'password_repeat') {
            $stmt->bindParam(':' . $field, $user[$field]);
        }
    }
    $success = $stmt->execute();
    return $success;
}


function createUserObject($row)
{
    $user = new User($row['id'], $row['username'], $row['password'], $row['firstname'], $row['lastname'], $row['zip'], $row['city'], $row['email'], $row['phone']);
    return $user;
}

function createListOfUsersObjects($result)
{
    $users = [];
    foreach ($result as $row) {
        $user = createUserObject($row);
        $users[] = $user;
    }
    return $users;
}



