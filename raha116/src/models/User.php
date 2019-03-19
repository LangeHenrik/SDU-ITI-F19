<?php


namespace models;


class User
{
    /**
     * @var int
     */
    public $user_id = -1;

    /**
     * @var string
     */
    public $username = '';

    /**
     * @var string
     */
    public $password = '';

    public $firstname = '';

    public $lastname = '';

    public $email = '';

    public $zip = '';

    public $phone = '';

    public $city = '';

    /**
     * User constructor.
     */
    public function __construct()
    {
        settype($this->user_id, 'int');
    }


}