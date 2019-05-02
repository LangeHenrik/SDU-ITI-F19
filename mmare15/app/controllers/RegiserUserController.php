<?php
/**
 * Created by PhpStorm.
 * User: matiasmarek
 */

namespace controllers;


class RegiserUserController
{


    public function register(){
        $register_service = new RegisterModel();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];

        $username_stripped = strip_tags($username);
        $password_stripped = strip_tags($password);
        $rpassword_stripped = strip_tags($rpassword);

        if ($password_stripped != $rpassword_stripped) {
            return $this->view("home/Register", array("password_match" => "Passwords does not match"));
        } else {
            if ($register_service->create_user($username_stripped, $password_stripped)) {
                header("location: /mmare15/mvc/public/login");
            } else {
                return $this->view("home/Register", array("user_exist" => "User already exist"));
            }

        }
    }




}