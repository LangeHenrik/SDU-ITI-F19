<?php
class User  {

    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $zip;
    public $city;
    public $mail;
    public $phone;


    public function __construct($username, $password, $firstname, $lastname, $zip, $city, $mail, $phone)
    {
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->zip = $zip;
        $this->city = $city;
        $this->mail = $mail;
        $this->phone = $phone;
    }

}