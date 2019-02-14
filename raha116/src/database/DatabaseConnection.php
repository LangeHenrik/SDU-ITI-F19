<?php
declare (strict_types=1);

namespace database;

use mysqli;

/**
 * Manages all connections to the database
 * @package database
 */
class DatabaseConnection
{

    private $conn;

    function __construct(string $servername, string $username, string $password, string $database)
    {
        $this->conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        echo "Connected to database!";
    }

    /**
     * Prepares a statement for execution
     * @param string $sql
     * @return \mysqli_stmt
     */
    public function prepare(string $sql)
    {
        return $this->conn->prepare($sql);
    }

    /**
     * Executes the given query
     * @param string $query
     * @return bool|\mysqli_result
     */
    public function run_query(string $query)
    {
        return $this->conn->query($query);
    }
}