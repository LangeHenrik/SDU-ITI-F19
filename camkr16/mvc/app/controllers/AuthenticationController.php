<?php

namespace controllers;

use services\APIJokeService;
use services\AuthenticationService;
use services\SignUpService;
use core\Controller;

class AuthenticationController extends Controller
{

    public function login()
    {
        $authservice = new AuthenticationService();

        $username_error = "";
        $password_error = "";
        $has_error = false;

        if ($this->post()) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if (empty($username)) {
                $has_error = true;
                $username_error = "Username is required";
            }
            if (empty($password)) {
                $has_error = true;
                $password_error = "Password required";
            }

            if (!$has_error) {
                if ($authservice->authenticate($username, $password)) {
                    header("Location: /camkr16/mvc/public/home");
                    return;
                } else {
                    $password_error = "Unknown user or password";
                }
            }
        }
        $joke = $this->joke();

        return $this->view("home/login", array("username_error" => $username_error, "password_error" => $password_error, "joke" => $joke));
    }

    public function signup()
    {
        $signupService = new SignUpService();

        $required_error = " is required";
        $username_error = "";
        $password_error = "";
        $repeatPassword_error = "";
        $firstname_error = "";
        $lastname_error = "";
        $zip_error = "";
        $city_error = "";
        $email_error = "";
        $phone_error = "";
        $has_error = false;

        if ($this->post()) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $repeatPassword = $_POST["repeatPassword"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $zip = $_POST["zip"];
            $city = $_POST["city"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];

            if (empty($username)) {
                $has_error = true;
                $username_error = "Username" . $required_error;
            }
            if (empty($password)) {
                $has_error = true;
                $password_error = "Password" . $required_error;
            }
            if (empty($repeatPassword)) {
                $has_error = true;
                $repeatPassword_error = "Repeat password" . $required_error;
            }
            if ($password != $repeatPassword) {
                $has_error = true;
                $repeatPassword_error = "Passwords are not the same";
            }
            if (empty($firstname)) {
                $has_error = true;
                $firstname_error = "Firstname" . $required_error;
            }
            if (empty($lastname)) {
                $has_error = true;
                $lastname_error = "Lastname" . $required_error;
            }
            if (empty($zip)) {
                $has_error = true;
                $zip_error = "Zip" . $required_error;
            }
            if (empty($city)) {
                $has_error = true;
                $city_error = "City" . $required_error;
            }
            if (empty($email)) {
                $has_error = true;
                $email_error = "Email" . $required_error;
            }
            if (empty($phone)) {
                $has_error = true;
                $phone_error = "Phone" . $required_error;
            }

            if (!$has_error) {
                if ($signupService->signUp($username, $password, $firstname, $lastname, $zip, $city, $email, $phone)) {
                    header("Location: /camkr16/mvc/public/home");
                };
            }
        }
        return $this->view("home/signup", array(
            "username_error" => $username_error,
            "password_error" => $password_error,
            "repeatPassword_error" => $repeatPassword_error,
            "firstname_error" => $firstname_error,
            "lastname_error" => $lastname_error,
            "zip_error" => $zip_error,
            "city_error" => $city_error,
            "email_error" => $email_error,
            "phone_error" => $phone_error));
    }

    public function logout()
    {
        session_destroy();
        header("location: /camkr16/mvc/public/authentication/login");
    }

    public function joke()
    {
        $jokeservice = new APIJokeService();
        return $jokeservice->getJoke();
    }


}
