<?php
declare(strict_types=1);

namespace database;


class UserRepository
{
    /**
     * @var \database\DatabaseConnection
     */
    private $conn;

    function __construct(\database\DatabaseConnection $conn)
    {
        $this->conn = $conn;
    }

    public function get_user(string $username)
    {
        $stmt = $this->conn->prepare("select username, password from users where users.username = ?");
    }
}