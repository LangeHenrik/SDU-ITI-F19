<?php
declare(strict_types=1);

namespace services;

use database\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create_user($username, $password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);


    }
}