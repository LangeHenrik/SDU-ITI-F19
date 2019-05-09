<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/userController.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/uploadController.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Users.php';



$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$request_method = $_SERVER["REQUEST_METHOD"];


switch ($request_method) {
    case 'GET':
        if (!empty($_GET["user_id"])) {
            $user_id = intval($_GET["user_id"]);
            $model = new Users();
            $userController = new userController($model);
            $userController->getimageFromID($user_id);
        } else {

            $model = new Users();
            $userController = new userController($model);
            $userController->getJsonUsers();
        }
        break;


    case 'POST':
        if (!empty($_POST["user_id"])) {

            $model = new Users();
            $userController = new userController($model);
            $uploader = new uploadController();
            $image = $_POST["image"];
            $title = $_POST["title"];
            $description = $_POST["description"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $login = $userController->VerifyUser($username, $password);
            if ($login == true) {
                $uploader->upload($username, $title ,$description, $image);
            }
        }
        break;
    default:

        header("HTTP/1.0 405 Method Not Allowed");
        break;
}