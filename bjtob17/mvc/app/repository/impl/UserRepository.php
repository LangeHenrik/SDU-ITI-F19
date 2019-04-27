<?php


namespace app\repository\impl;


use app\model\dto\UserRegisterDto;
use app\model\User;
use app\repository\DbResultMapper;
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
        $stmt = $this->db->getPDO()->prepare("SELECT user_id, username, hashedPassword, firstName, lastName, zip, city, email, phone, user.created_at AS user_created_at, user.updated_at AS user_updated_at FROM user");
        $stmt->execute();
        $dbData = $stmt->fetchAll();
        $users = [];
        foreach($dbData as $user) {
            array_push($users, DbResultMapper::toUser($user));
        }
        return $users;
    }

    function findById(int $id): ?User
    {
        $returnUser = null;
        $stmt = $this->db->getPDO()->prepare("SELECT user_id, username, hashedPassword, firstName, lastName, zip, city, email, phone, user.created_at AS user_created_at, user.updated_at AS user_updated_at FROM user WHERE user_id = ?");
        $stmt->execute([$id]);
        $dbData = $stmt->fetch();
        if ($dbData) {
            $returnUser = DbResultMapper::toUser($dbData);
        }
        return $returnUser;
    }

    function create(UserRegisterDto $userDto): bool
    {
        $stmt = $this->db->getPDO()->prepare(
            "INSERT INTO user (username, hashedPassword, firstName, lastName, zip, city, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$userDto->username, $userDto->hashedPassword, $userDto->firstName, $userDto->lastName,
            $userDto->zip, $userDto->city, $userDto->email, $userDto->phone]);

    }

    function findByUsername(string $username): ?User
    {
        $returnUser = null;
        $stmt = $this->db->getPDO()->prepare("SELECT user_id, username, hashedPassword, firstName, lastName, zip, city, email, phone, user.created_at AS user_created_at, user.updated_at AS user_updated_at  FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $dbData = $stmt->fetch();
        if ($dbData) {
            $returnUser = DbResultMapper::toUser($dbData);
        }
        return $returnUser;
    }
}