<?php
/**
 * Created by PhpStorm.
 * User: matiasmarek
 */

namespace controllers;
use core\Controller;
use models\loginModel;

class LoginController extends Controller
{
    public function index(){
        return $this->view("home/Login");
    }

    public function login(){

        $loginModel = new loginModel();
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username_stripped = strip_tags($username,"<b>");
        $password_stripped = strip_tags($password,"<b>");

        if($loginModel->login($username_stripped, $password_stripped) == true){
            session_start();
            $_SESSION['login_user'] = $username;
            header("location: /mmare15/mvc/public/home");

        } else if ($loginModel->login()) {
            return $this->view("home/Login", array("error_msg" => "Oops! Something went wrong. Please try again"));
        }
    }
}
