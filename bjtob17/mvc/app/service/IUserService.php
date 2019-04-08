<?php


namespace app\service;


use app\model\dto\UserDto;
use app\model\User;

interface IUserService
{
    function findAll(): array;

    function findById(int $id): ?User;

    function create(UserDto $userDto);
}