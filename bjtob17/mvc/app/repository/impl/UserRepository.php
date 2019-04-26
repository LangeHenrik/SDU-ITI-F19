<?php


namespace app\repository\impl;


use app\model\User;
use app\repository\IUserRepository;
use DateTime;
use framework\database\IDatabaseConnection;

class UserRepository implements IUserRepository
{

    /**
     * @var IDatabaseConnection
     */
    private $db;

    /**
     * UserRepository constructor.
     * @param IDatabaseConnection $db
     */
    public function __construct(IDatabaseConnection $db)
    {
        $this->db = $db;
    }

    function findAll(): array
    {
        // TODO: Implement findAll() method.
        return [
            new User(1, "bob", new DateTime("NOW"), new DateTime("NOW")),
            new User(2, "also bob", new DateTime("NOW"), new DateTime("NOW")),
        ];
    }

    function findById(int $id): ?User
    {
        // TODO: Implement findById() method.
        return null;
    }

    function create(User $user)
    {
        // TODO: Implement create() method.
    }

    function findByUsername(string $username): ?User
    {
        // TODO: Implement findByUsername() method.
        return null;
    }
}