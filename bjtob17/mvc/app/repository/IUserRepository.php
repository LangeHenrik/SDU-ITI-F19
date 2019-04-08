<?php


namespace app\repository;


use app\model\User;

interface IUserRepository
{
    function findAll(): array;

    function findById(int $id): ?User;

    function create(User $user);
}