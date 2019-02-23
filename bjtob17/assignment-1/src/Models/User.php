<?php


namespace Models;


class User extends Entity
{

    public $username;
    public $hashedPassword;

    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $hashedPassword
     */
    public function __construct($id, $username, $hashedPassword)
    {
        $this->id = $id;
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
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