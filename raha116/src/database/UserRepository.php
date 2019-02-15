<?php
declare(strict_types=1);

namespace database;


class UserRepository
{
    /**
     * @var DatabaseConnection
     */
    private $conn;

    function __construct(DatabaseConnection $conn)
    {
        $this->conn = $conn;
    }

    public function get_user(string $username)
    {
        $stmt = $this->conn->prepare("select username, password from users where users.username = ?");
    }
}