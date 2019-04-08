<?php


namespace app\service\impl;


use app\service\IAuthService;

class AuthService implements IAuthService
{

    function isLoggedInWeb(): bool
    {
        // TODO: Implement isLoggedInWeb() method.
        return false;
    }

    function isLoggedInApi(string $username, string $password): bool
    {
        if ($username === "bob" && $password === "password") {
            return true;
        } else {
            return false;
        }
    }
}