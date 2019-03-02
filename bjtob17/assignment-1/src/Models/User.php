<?php


namespace Models;


class User extends Entity
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
     * User constructor.
     * @param $id
     * @param $username
     * @param $hashedPassword
     * @param $firstName
     * @param $lastName
     * @param $zip
     * @param $city
     * @param $email
     * @param $phone
     */
    public function __construct($id, $username, $hashedPassword, $firstName, $lastName, $zip, $city, $email, $phone)
    {
        $this->id = $id;
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->zip = $zip;
        $this->city = $city;
        $this->email = $email;
        $this->phone = $phone;
    }


    public static function generateHash(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }

    public function verifyPassword(string $plaintextPassword): bool
    {
        return password_verify($plaintextPassword, $this->hashedPassword);
    }
}