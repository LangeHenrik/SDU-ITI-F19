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
}