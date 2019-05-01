<?php

class User
{
    // [{"user_id":"1","username":"jack"},{"user_id":"2", "username":"jill"}]
    public $user_id;
    public $username;

    public function __construct($user_id, $username)
    {
        $this->user_id = $user_id;
        $this->username = $username;
    }
}