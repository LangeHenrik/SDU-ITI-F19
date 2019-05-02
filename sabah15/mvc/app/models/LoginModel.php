<?php

class LoginModel
{
    public $mailuid;
    public $password;

    public function __construct($mailuid, $password)
    {
        $this->mailuid = $mailuid;
        $this->password = $password;
    }
}