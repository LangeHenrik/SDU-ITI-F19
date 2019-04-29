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
        $stmt = $this->db->getPDO()->prepare("SELECT user_id, username, hashedPassword, firstName, lastName, zip, city, email, phone FROM user ORDER BY created_at DESC");
        $stmt->execute();
        $dbData = $stmt->fetchAll();

        $users = [];
        foreach($dbData as $user) {
            array_push($users, Helper::createUser($user));
        }

        return $users;
    }

    public function getById(int $id): ?User
    {
        $user = null;

        $stmt = $this->db->getPDO()->prepare("SELECT user_id, username, hashedPassword, firstName, lastName, zip, city, email, phone FROM user WHERE id = ?");
        $stmt->execute([$id]);
        $dbData = $stmt->fetch();

        if (count($dbData) > 0) {
            $user = Helper::createUser($dbData);
        }

        return $user;
    }

    public function getByUsername(string $username): ?User
    {
        $returnUser = null;

        $stmt = $this->db->getPDO()->prepare("SELECT user_id, username, hashedPassword, firstName, lastName, zip, city, email, phone FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $dbData = $stmt->fetch();
        if ($dbData) {
            $returnUser = Helper::createUser($dbData);
        }

        return $returnUser;
    }

    public function add(UserDto $userDto): bool
    {
        $stmt = $this->db->getPDO()->prepare("INSERT INTO user (username, hashedPassword, firstName, lastName, zip, city, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $success = $stmt->execute([$userDto->username, $userDto->hashedPassword, $userDto->firstName, $userDto->lastName,
            $userDto->zip, $userDto->city, $userDto->email, $userDto->phone]);
        return $success;
    }
}