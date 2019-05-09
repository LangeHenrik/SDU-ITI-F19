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
            $username = $_POST["uid"];
            $password = $_POST["pwd"];
            $repeatPassword = $_POST["pwd-repeat"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $zip = $_POST["zip"];
            $city = $_POST["city"];
            $email = $_POST["mail"];
            $phone = $_POST["phone"];

            //echo $username,$password,$repeatPassword,$firstname,$lastname,$zip,$city,$email,$phone;
            if ($signupService->registerUser($username, $email, $password, $repeatPassword, $firstname, $lastname, $zip, $city, $phone)) {

                header("Location: /sabah15/mvc/public/home/");
            }
            else {

                header("Location: /sabah15/mvc/public/home/signup/");
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