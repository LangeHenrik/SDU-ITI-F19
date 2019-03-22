<?php
/**
 * Created by IntelliJ IDEA.
 * User: bt
 * Date: 22/02/19
 * Time: 19:41
 */

namespace Models\Dto;


use Models\User;

class UserDto
{
    public $username;
    public $hashedPassword;

    public $firstName;
    public $lastName;
    public $zip;
    public $city;
    public $email;
    public $phone;

    /**
     * UserDto constructor.
     * @param $id
     * @param $username
     * @param $plainTextPassword
     * @param $firstName
     * @param $lastName
     * @param $zip
     * @param $city
     * @param $email
     * @param $phone
     */
    public function __construct($username, $plainTextPassword, $firstName, $lastName, $zip, $city, $email, $phone)
    {
        $this->username = $username;
        $this->hashedPassword = User::generateHash($plainTextPassword);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->zip = $zip;
        $this->city = $city;
        $this->email = $email;
        $this->phone = $phone;
    }

}