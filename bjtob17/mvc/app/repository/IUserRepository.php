<?php


namespace app\repository;


use app\model\dto\UserRegisterDto;
use app\model\User;

interface IUserRepository
{
    function findAll(): array;

    function findById(int $id): ?User;

    function findByUsername(string $username): ?User;

    function create(UserRegisterDto $user): bool;
}