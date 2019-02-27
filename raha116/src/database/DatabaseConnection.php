<?php
declare (strict_types=1);

namespace database;

use Exception;
use mysqli;
use mysqli_result;

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

    public function run_multi_query(string $query)
    {
        $result = $this->conn->multi_query($query);
        if ($result) {
            // multi_query does buffering, so we have to clear the buffer
            while ($this->conn->next_result()) ;
        }
        return $result;
    }

    /**
     * @param string $query
     * @param string $param_types
     * @param mixed ...$params
     * @return bool|mysqli_result
     */
    public function execute_prepared_query(string $query, string $param_types, ...$params)
    {
        $stmt = $this->prepare($query);
        if ($stmt === false) {
            throw new Exception("Failed to prepare query: " . $this->get_last_error());
        }

        if ($param_types) {
            $stmt->bind_param($param_types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute query: " . $stmt->error);
        }

        return $stmt->get_result();
    }

    /**
     * Executes a query for a single row
     *
     * @param string $query
     * @param string $class The class to convert the result into
     * @param string $param_types
     * @param string[] $params
     * @return mixed
     */
    public function query_single_row(string $query, string $class, string $param_types, ...$params)
    {
        if (!$params) {
            $params = array();
        }
        $result = $this->execute_prepared_query($query, $param_types, ...$params);

        if ($result == null) {
            return null;
        }

        return $result->fetch_object($class);
    }

    /**
     * Gets the id of the last inserted entry for this connection
     *
     * @return int
     */
    public function get_last_inserted_id(): int
    {
        return $this->query_single_row("select LAST_INSERT_ID() as id", EntryId::class, "")->id;
    }

    /**
     * Queries for all the rows in the collection
     *
     * @param string $query
     * @param string $class
     * @param string $param_types
     * @param string[] $params
     * @return array of whatever class was passed
     */
    public function query_multiple_rows(string $query, string $class, string $param_types, string ...$params)
    {
        $result = $this->execute_prepared_query($query, $param_types, ...$params);

        if ($result == null) {
            return array();
        }

        $results = array();

        while ($row = $result->fetch_object($class)) {
            $results[] = $row;
        }

        return $results;
    }

    /**
     * Indicates if there is currently a running transaction.
     * Used to avoid nested transaction
     *
     * @var bool
     */
    private $running_transaction = false;

    /**
     * Starts a new transaction
     *
     * @param bool $read_only
     * @return bool
     */
    public function begin_transaction()
    {
        if ($this->running_transaction) {
            throw new Exception('Attempted to start transaction, while another transaction is already in progress');
        }

        $this->running_transaction = true;

        return $this->conn->begin_transaction();
    }

    /**
     * Commits the updates from an in progress transaction
     */
    public function commit_transaction(): bool
    {
        if (!$this->running_transaction) {
            throw new Exception("No in progress transaction to commit");
        }

        $this->running_transaction = false;

        return $this->conn->commit();
    }

    /**
     * Rolls back the in progress transaction
     *
     * @return bool
     */
    public function rollback_transaction(): bool
    {
        if (!$this->running_transaction) {
            throw new Exception("No in progress transaction to rollback");
        }

        $this->running_transaction = false;

        return $this->conn->rollback();
    }

    /**
     * Gets the last error that happened
     *
     * @return string
     */
    public function get_last_error(): string
    {
        return $this->conn->error;
    }
}