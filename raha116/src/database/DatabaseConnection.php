<?php
declare (strict_types=1);

namespace database;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Manages all connections to the database
 * @package database
 */
class DatabaseConnection
{

    /**
     * @var PDO $conn
     */
    private $conn;

    function __construct(string $servername, string $username, string $password, string $database)
    {
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password, array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY));
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Prepares a statement for execution
     * @param string $sql
     * @return PDOStatement
     */
    public function prepare(string $sql)
    {
        return $this->conn->prepare($sql, array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY));
    }

    /**
     * Executes the given query
     * @param string $query
     * @return false|PDOStatement
     */
    public function run_query(string $query)
    {
        return $this->conn->query($query);
    }

    public function run_multi_query(string $query)
    {
        $result = $this->conn->query($query);
        if ($result) {
            // multi_query does buffering, so we have to clear the buffer
            while ($result->fetchAll()) ;
        }
        $result->closeCursor();

        return $result;
    }

    /**
     * @param string $query
     * @param mixed ...$params
     * @return bool|PDOStatement
     */
    public function execute_prepared_query(string $query, ...$params)
    {
        $stmt = $this->prepare($query);
        if ($stmt === false) {
            throw new Exception("Failed to prepare query: " . $this->get_last_error());
        }

        if (!$stmt->execute($params)) {
            throw new Exception("Failed to execute query: " . json_encode($stmt->errorInfo()));
        }

        return $stmt;
    }

    /**
     * Executes a query for a single row
     *
     * @param string $query
     * @param string $class The class to convert the result into
     * @param string[] $params
     * @return mixed
     */
    public function query_single_row(string $query, string $class, ...$params)
    {
        if (!$params) {
            $params = array();
        }
        $result = $this->execute_prepared_query($query, ...$params);

        if ($result == null) {
            return null;
        }

        return $result->fetchObject($class);
    }

    /**
     * Gets the id of the last inserted entry for this connection
     *
     * @return int
     */
    public function get_last_inserted_id(): int
    {
        $id = $this->query_single_row("select LAST_INSERT_ID() as id", EntryId::class)->id;

        settype($id, 'int');

        return $id;
    }

    /**
     * Queries for all the rows in the collection
     *
     * @param string $query
     * @param string $class
     * @param string[] $params
     * @return array of whatever class was passed
     */
    public function query_multiple_rows(string $query, string $class, string ...$params)
    {
        $result = $this->execute_prepared_query($query, ...$params);

        if ($result == null) {
            return array();
        }

        $results = array();

        while ($row = $result->fetchObject($class)) {
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

        return $this->conn->beginTransaction();
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
        return json_encode($this->conn->errorInfo());
    }
}