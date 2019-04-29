<?php 

namespace Models\DTO;

class UserDTO{
    public $username;
    public $password_hashed;
    public $firstname;
    public $lastname;
    public $city;
    public $zip;
    public $email;
    public $phone;

    public function __construct($username, $password_hashed, $firstname, $lastname, $city, $zip, $email, $phone){
        $this->username = $username;
        $this->password_hashed = $password_hashed;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->city = $city;
        $this->zip = $zip;
        $this->email = $email;
        $this->phone = $phone;
    }
}