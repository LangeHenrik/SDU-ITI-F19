<?php
require "../app/services/UserService.php";
require "../app/services/SignupService.php";

class UserController extends Controller
{



    public function login()
    {
        $userService = new UserService();
        if ($this->post()) {
            $mailuid = $_POST["mailuid"];
            $password = $_POST["password"];
            if ($userService->login($mailuid, $password)) {
                return $this->view("home/index");
            }
        }
        return $this->view("home/index");
    }

    public function signup()
    {
        $signupService = new SignupService();
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

            if ($signupService->registerUser($username, $email, $password, $repeatPassword, $firstname, $lastname, $zip, $city, $phone)) {
                return $this->view("home/signup");
            }
            else {
                return $this->view("home/signup");
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        return $this->view("home/index");
    }
}