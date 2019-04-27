<?php


namespace app\service;


use app\model\dto\UserLoginDto;

interface IAuthService
{
    function isLoggedInWeb(): bool;

    function isLoggedInApi(string $username, string $password): bool;

    function login(UserLoginDto $loginDto): array;

    function logout();
}