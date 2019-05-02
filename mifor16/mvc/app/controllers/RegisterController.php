<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 09:49
 */

namespace controllers;


use core\Controller;
use models\RegisterModel;

class RegisterController extends Controller
{

    public function index() {
        return $this->view("home/Register");
    }

    public function register() {

        if($this->post()) {
            $registerService = new RegisterModel();

            $un = $_POST['username']; $pw = $_POST['password'];
            $fn = $_POST['firstname']; $ln = $_POST['lastname'];
            $c = $_POST['city']; $z = $_POST['zip'];
            $mail = $_POST['mail']; $phone = $_POST['phone'];

            $registerService->registerUser($un, $pw, $fn, $ln, $c, $z, $mail, $phone);
            header("Location: /mifor16/mvc/public/Login)");
        }
    }
}