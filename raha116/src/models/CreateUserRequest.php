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

    /**
     * Validates the input
     * Returns null if everything is okay
     *
     * @return string|null
     */
    public function validate()
    {
        if ($this->username == null) {
            return "Username was null";
        }
        if ($this->password == null) {
            return "Password was null";
        }

        if (strlen(trim($this->username)) == "") {
            return "Username was empty";
        }
        if (strlen(trim($this->password)) < 6) {
            return "Password was less than 6 characters";
        }

        if (strlen($this->username) > 20) {
            return "Username cannot be more than 20 characters";
        }

        return null;
    }
}