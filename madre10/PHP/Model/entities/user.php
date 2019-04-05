<?php

class User
{
    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $zip;
    public $city;
    public $email;
    public $phone;

    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $password
     * @param $firstname
     * @param $lastname
     * @param $zip
     * @param $city
     * @param $email
     * @param $phone
     */
    public function __construct($id, $username, $password, $firstname, $lastname, $zip, $city, $email, $phone)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->zip = $zip;
        $this->city = $city;
        $this->email = $email;
        $this->phone = $phone;
    }
}
