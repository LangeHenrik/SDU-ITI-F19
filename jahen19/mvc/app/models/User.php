<?php
class User extends Database {

    public $name;
    public $hashed_password;
    public $city;
    public $email;

    public function __toString() {
        return $this->name;
    }

    // username may only contain letters A-Z and digits 0-9, maximum length 30 chars
    public function checkUsername() {
        if (strlen($this->name) <= 0 || strlen($this->name) > 30) {
            return false;
        }
        return preg_match('/^[a-zA-Z0-9]*$/', $str);
    }

}
