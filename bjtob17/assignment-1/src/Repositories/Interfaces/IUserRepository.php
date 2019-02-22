<?php
/**
 * Created by IntelliJ IDEA.
 * User: bt
 * Date: 2/22/19
 * Time: 10:07 AM
 */

namespace Repositories\Interfaces;


use Models\User;

interface IUserRepository
{
    public function getAll(): array;

    public function getById($id): User;

    public function getByUsername($username): User;

    public function add($user);
}