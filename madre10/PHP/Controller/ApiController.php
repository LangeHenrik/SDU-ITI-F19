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
    $posts = getUserPosts($userId);
    echo json_encode($posts);
}

function apiPostPicture($userId){
    header("Content-Type: application/json; charset=UTF-8");
    $data = $_POST["json"];
    //TODO: Save it;
    echo "Not implemented yet.";
}



