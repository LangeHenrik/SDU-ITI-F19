<?php


namespace Repositories;

use Models\User;

class UserRepository
{
    private $users;

    public function __construct()
    {
        $this->users = [new User(1, "bob", "secret")];
    }

    public function getAll(): array
    {
        return $this->users;
    }

    public function getById($id): User
    {
        return $this->users[$id];
    }

    public function getByUsername($username): User
    {
        $returnUser = null;
        foreach($this->users as $user) {
            if ($user->username === $username) {
                $returnUser = $user;
                break;
            }
        }

        return $returnUser;
    }

    public function add($user)
    {
        $this->users[$user->id] = $user;
    }
}