<?php

namespace App\Core\Utility;

class Hash
{

    /**
     * Generate a password hash
     *
     * @param $password
     * @return bool|string
     */
    public static function generate($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verify a password hash
     *
     * @param $password
     * @param $hash
     * @return bool
     */
    public static function validate($password, $hash) {
        return password_verify($password, $hash);
    }

}