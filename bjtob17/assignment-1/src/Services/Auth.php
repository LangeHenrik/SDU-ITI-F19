<?php

namespace Services;


class Auth
{
    public static function startSession()
    {
        session_start();
    }

    public static function isLoggedIn(): bool
    {
        return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true);
    }
}
Auth::startSession();