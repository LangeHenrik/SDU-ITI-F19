<?php


namespace app\model;


use DateTime;

class User extends Entity
{
    /**
     * @var int
     */
    public $user_id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $hashedPassword;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var int
     */
    public $zip;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $email;

    /**
     * @var int
     */
    public $phone;

    /**
     * User constructor.
     * @param int $user_id
     * @param string $username
     * @param string $hashedPassword
     * @param string $firstName
     * @param string $lastName
     * @param int $zip
     * @param string $city
     * @param string $email
     * @param int $phone
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct(int $user_id, string $username, string $hashedPassword, string $firstName, string $lastName, int $zip, string $city, string $email, int $phone, DateTime $createdAt, DateTime $updatedAt)
    {
        parent::__construct($createdAt, $updatedAt);
        $this->user_id = $user_id;
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