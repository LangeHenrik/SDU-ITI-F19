<?php

class RegisterModel
{
    public $username;
    public $email;
    public $password;
    public $repeatPassword;
    public $firstname;
    public $lastname;
    public $zip;
    public $city;
    public $telephone;


    public function __construct($username, $email, $password, $repeatPassword, $firstname, $lastname, $zip, $city, $phone)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->repeatPassword = $repeatPassword;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->zip = $zip;
        $this->city = $city;
        $this->telephone = $phone;
    }
}