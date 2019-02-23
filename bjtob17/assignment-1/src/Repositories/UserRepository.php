<?php


namespace Repositories;

use Database\Interfaces\IDatabaseConnection;
use DependencyInjector\DependencyInjectionContainer;
use Models\Dto\UserDto;
use Models\User;
use Repositories\Interfaces\IUserRepository;

class UserRepository implements IUserRepository
{
    private $di;
    private $config;
    /**
     * @var IDatabaseConnection;
     */
    private $db;

    public function __construct($config, DependencyInjectionContainer $di)
    {
        $this->config = $config;
        $this->di = $di;
        $this->db = $di->get(IDatabaseConnection::class);
    }

    public function getAll(): array
    {
        $stmt = $this->db->getPDO()->prepare("SELECT id, username, hashedPassword FROM users");
        $stmt->execute();
        $dbData = $stmt->fetchAll();

        $users = [];
        foreach($dbData as $user) {
            array_push($users, new User($user["id"], $user["username"], $user["hashedPassword"]));
        }

        return $users;
    }

    public function getById(int $id): ?User
    {
        $user = null;

        $stmt = $this->db->getPDO()->prepare("SELECT id, username, hashedPassword FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $dbData = $stmt->fetch();

        if (count($dbData) > 0) {
            $user = new User($dbData["id"], $dbData["username"], $dbData["hashedPassword"]);
        }

        return $user;
    }

    public function getByUsername(string $username): ?User
    {
        $returnUser = null;

        $stmt = $this->db->getPDO()->prepare("SELECT id, username, hashedPassword FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $dbData = $stmt->fetch();
        if ($dbData) {
            $returnUser = new User($dbData["id"], $dbData["username"], $dbData["hashedPassword"]);
        }

        return $returnUser;
    }

    public function add(UserDto $userDto): bool
    {
        $stmt = $this->db->getPDO()->prepare("INSERT INTO users (username, hashedPassword) VALUES (?, ?)");
        $success = $stmt->execute([$userDto->username, $userDto->hashedPassword]);
        return $success;
    }
}