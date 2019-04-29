<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-29
 * Time: 13:33
 */

namespace controllers;


use services\LoginService;
use core\Controller;

class AuthenticationController extends Controller
{
    public function login() {
        $loginService = new LoginService();
        $error = false;
        echo "fuck you";
        if($this->post()) {

            $theusername = $_POST['username'];
            $thepassword = $_POST['password'];

            if(empty($theusername) or empty($thepassword)) {
                $error = true;
            }

            if(!$error) {
                if($loginService->checkCredentials($theusername, $thepassword)) {
                    header("Location: mifor16/mvc/public/bigpepe");
                }
                else {
                    echo "ruhroh";
                }
            }
        }
    }
}