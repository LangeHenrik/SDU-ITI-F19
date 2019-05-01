<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:34
 */

namespace controllers;
use core\Controller;
use models\LoginModel;
class LoginController extends Controller
{
    public function index(){
        return $this->view("home/Login");
    }
    public function login(){
        $loginModel = new LoginModel();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $username_stripped = strip_tags($username,"<b>");
        $password_stripped = strip_tags($password,"<b>");
        if($loginModel->login($username_stripped, $password_stripped) == true){
            session_start();
            $_SESSION['login_user'] = $username;
            header("location: /jonasr16/mvc/public/home");
        } else {
            return $this->view("home/Login", array("error_msg" => "username or password was not correct"));
        }
    }
}
