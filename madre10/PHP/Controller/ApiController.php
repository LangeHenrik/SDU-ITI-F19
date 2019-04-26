<?php

require_once(__DIR__ . '/../Model/userDAO.php');
require_once(__DIR__ . '/../Model/postDAO.php');
require_once(__DIR__ . '/../Model/commentDAO.php');


function apiGetAllUsers()
{
    header("Content-Type: application/json; charset=UTF-8");
    $users = getAllUsers();

    echo json_encode($users);
}

function apiGetUserPictures($userId){
    header("Content-Type: application/json; charset=UTF-8");
    $posts = getUserImagesSimple($userId);
    echo json_encode($posts);
}

function apiPostPicture($userId){
    header("Content-Type: application/json; charset=UTF-8");
    $data = json_decode(file_get_contents('php://input'), true);
    $title = $data['title'];
    $description = $data['description'];
    $image = $data['image'];
    $username = $data['username'];
    $password = $data['password'];

    $user = getUserByUsername($username);
    //Check that user exists
    if($user==null) {
        echo "Sorry, no such user";
    } elseif ($user['password'] != $password){
        echo "Sorry, wrong password";
    } else {
        $id = addPost($title, $description, $image, $userId);
        if($id >= 0) {
            $result = new stdClass;
            $result->image_id = $id;
            echo json_encode($result);
        } else {
            echo "Something went wrong";
        }


    }




}



