<?php


namespace app\service;


use app\model\dto\UserLoginDto;
use app\model\dto\UserRegisterDto;
use app\model\User;

interface IUserService
{
    function findAll(): array;

    function findByUsername(string $username): ?User;

    function create(UserRegisterDto $userDto): array;
}