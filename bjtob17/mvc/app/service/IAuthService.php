<?php


namespace app\service;


interface IAuthService
{
    function isLoggedInWeb(): bool;

    function isLoggedInApi(string $username, string $password): bool;
}