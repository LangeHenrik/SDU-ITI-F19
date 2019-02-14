<?php


namespace models;


class User
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
    public $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
}