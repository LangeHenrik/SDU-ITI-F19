<?php
/**
 * Created by PhpStorm.
 * User: hanse
 * Date: 15-02-2019
 * Time: 09:29
 */

namespace models;


class CreateUserRequest
{
    public $username = "";

    public $password = "";

    public function __toString()
    {
        return "CreateUserRequest($this->username, $this->password)";
    }
}