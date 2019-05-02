<?php


namespace app\util;


class AuthUtil
{
    public static function isLoggedIn(): bool
    {
        return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true);
    }

    public static function getLoggedinUsername()
    {
        if (isset($_SESSION["username"])) {
            return $_SESSION["username"];
        } else {
            return "";
        }
    }
}