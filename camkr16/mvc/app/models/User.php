<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ejer
 * Date: 25-04-2019
 * Time: 17:11
 */

namespace models;


class User
{
    public $userid;
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
     * @param $userid
     * @param $username
     * @param $password
     * @param $firstname
     * @param $lastname
     * @param $zip
     * @param $city
     * @param $email
     * @param $phone
     */
    public function __construct($userid, $username, $password, $firstname, $lastname, $zip, $city, $email, $phone)
    {
        $this->userid = $userid;
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