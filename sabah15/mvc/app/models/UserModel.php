<?php

class UserModel
{
    public $username;
    public $email;
    public $firstname;
    public $lastname;
    public $telephone;


    public function __construct($username, $email, $firstname, $lastname, $city)
    {
        $this->username = $username;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->city = $city;
    }
}