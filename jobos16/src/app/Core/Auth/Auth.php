<?php

namespace App\Core\Auth;

class Auth
{

    /**
     * Set session ID
     *
     * @param $userID
     * @return bool
     */
    public static function authenticate($userID)
    {
        $_SESSION['session'] = $userID;

        return true;
    }

    /**
     * Get session ID
     *
     * @return mixed
     */
    public static function currentSession() {
        return $_SESSION['session'];
    }

    /**
     * Check if a session is present
     *
     * @return bool
     */
    public static function isAuthenticated() : bool
    {
        return array_key_exists("session", $_SESSION);
    }

}