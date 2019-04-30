<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-29
 * Time: 13:33
 */

namespace controllers;

use core\Controller;
use models\LoginModel;

class LoginController extends Controller
{

    public function index() {
        return $this->view("home/Login");
    }

    public function login() {
        $loginService = new LoginModel();
        if($this->post()) {

            $theusername = $_POST['username'];
            $thepassword = $_POST['password'];
            if($loginService->checkCredentials($theusername, $thepassword) == true) {
                session_start();
                $_SESSION['login_user'] = $theusername;
                header("Location: /mifor16/mvc/public/home");
            }
            else {
                return $this->view("home/Login", array("error_msg" => "Username or Password was incorrect"));
            }
        }
    }
}