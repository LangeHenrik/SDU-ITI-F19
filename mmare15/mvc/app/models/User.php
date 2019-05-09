<?php

class User  {

    public $username;
    public $password;
    public $firstName;
    public $lastName;
    public $zip;
    public $city;
    public $mail;
    public $phone;

    public function __construct($username, $password, $firstName, $lastName, $zip, $city, $mail, $phone)
    {
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->zip = $zip;
        $this->city = $city;
        $this->mail = $mail;
        $this->phone = $phone;
    }
}