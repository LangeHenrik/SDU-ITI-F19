<?php
declare(strict_types=1);

namespace repositories;


use database\DatabaseConnection;
use Exception;
use models\User;

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


    /**
     * Loads the given user from the database
     *
     * @param string $username
     * @return User|null
     */
    public function get_user(string $username)
    {
        return $this->conn->query_single_row("select user_id, username, password from users where users.username = ?", User::class, "s", $username);
    }

    /**
     * Creates a new user with the given details
     *
     * @param string $username
     * @param string $hash
     * @return User|null
     */
    public function create_user(string $username, string $hash)
    {
        if (!$this->conn->begin_transaction()) {
            throw new Exception("Failed to start transaction: " . $this->conn->get_last_error());
        }

        $this->conn->execute_prepared_query("insert into users(username, password) values (?, ?);", "ss", $username, $hash);

        $user = $this->get_user($username);

        if (!$this->conn->commit_transaction()) {
            throw new Exception("Failed to commit transaction: " . $this->conn->get_last_error());
        }

        return $user;
    }
}