<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:35
 */
namespace controllers;
use core\Controller;
use models\RegisterModel;
class RegisterController extends Controller
{
    public function index(){
        return $this->view("home/Register");
    }
    public function register(){
        $register_service = new RegisterModel();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $email = $_POST['email'];
        $phonenumber = $_POST["phonenumber"];
        $username_stripped = strip_tags($username, "<b>");
        $password_stripped = strip_tags($password, "<b>");
        $rpassword_stripped = strip_tags($rpassword, "<b>");
        $firstname_stripped = strip_tags($firstname, "<b>");
        $lastname_stripped = strip_tags($lastname, "<b>");
        $zip_stripped = strip_tags($zip, "<b>");
        $city_stripped = strip_tags($city, "<b>");
        $email_stripped = strip_tags($email, "<b>");
        $phonenumber_stripped = strip_tags($phonenumber, "<b>");
        if ($password_stripped != $rpassword_stripped) {
            return $this->view("home/Register", array("password_match" => "Passwords does not match"));
        } else {
            if ($register_service->create_user($username_stripped, $password_stripped, $firstname_stripped,
                $lastname_stripped, $zip_stripped, $city_stripped, $email_stripped, $phonenumber_stripped)) {
                header("location: /jonasr16/mvc/public/login");
            } else {
                return $this->view("home/Register", array("user_exist" => "User already exist"));
            }
        }
    }
}
