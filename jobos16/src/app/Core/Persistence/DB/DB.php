<?php

namespace App\Core\Persistence\DB;

use App\Core\Config;
use \PDO;
use \PDOException;

class DB
{

    private static $instance = null;
    private $_connection;
    private $_fetchMode;
    private $_results;
    private $_count = 0;

    public function __construct($host = "", $username = "", $password = "", $database = "")
    {
        try {
            $this->_connection = new \PDO("mysql:host={$host};dbname={$database};charset=utf8mb4", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (\PDOException $exception) {
            die($exception);
        }
    }

    /**
     * @return DB
     */
    public static function instance() : DB
    {
        if (self::$instance === null) {
            self::$instance = new DB(
                Config::get('mysql/host'),
                Config::get('mysql/username'),
                Config::get('mysql/password'),
                Config::get('mysql/database')
            );
        }

        return self::$instance;
    }

    public function setFetchObject($class)
    {
        $this->_fetchMode = [PDO::FETCH_CLASS, $class];
        return $this;
    }

    public function query($sql, $params = [], $fetch = true) {
        $this->_error = false;

        $x = 1;
        if($this->_query = $this->_connection->prepare($sql)) {
            if(count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
        }

        if ($this->_query->execute()) {
            if($fetch) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }
        } else {
            $this->_error = true;
        }

        return $this;
    }

    public function action($action, $table, $where = []) {
        if(count($where) === 3) {
            $operators = array("=", ">", "<", ">=", "<=");

            $field 		= $where[0];
            $operator 	= $where[1];
            $value 		= $where[2];

            if(in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if($action == "GET") {
                    $fetch = true;
                } else {
                    $fetch = false;
                }

                if(!$this->query($sql, [$value], $fetch)->error()) {
                    return $this;
                }
            }
        }

        return false;
    }

    public function get($table, $where) {
        return $this->action("SELECT *", $table, $where);
    }

    public function delete($table, $where) {
        if($this->action("DELETE", $table, $where)) {
            return true;
        }
        return false;
    }

    public function insert($table, $fields = [], $append = null) {
        $keys = array_keys($fields);
        $values = "";
        $x = 1;

        foreach ($fields as $field) {
            $values .= "?";

            if ($x < count($fields)) {
                $values .= ", ";
            }

            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys). "`) VALUES ({$values})";

        if(!empty($append)) {
            $sql .= $append;
        }

        if(!$this->query($sql, $fields, false)->error()) {
            return true;
        }

        return false;
    }

    public function insertIgnore($table, $fields = array()) {
        $keys = array_keys($fields);
        $values = "";
        $x = 1;

        foreach ($fields as $field) {
            $values .= "?";

            if ($x < count($fields)) {
                $values .= ", ";
            }

            $x++;
        }

        $sql = "INSERT IGNORE INTO {$table} (`" . implode('`, `', $keys). "`) VALUES ({$values})";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function update($table, $id, $fields, $row = "id") {
        $set = "";
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "`{$name}` = ?";

            if($x < count($fields)) {
                $set .= ", ";
            }

            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE {$row} = {$id}";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    /**
     * Get last inserted ID
     *
     * @return int|string
     */
    public function lastInsertId()
    {
        return (is_numeric($this->_connection->lastInsertId())) ? (int)$this->_connection->lastInsertId() : $this->_connection->lastInsertId();
    }

    public function results() {
        return $this->_results;
    }

    public function first() {
        return $this->results()[0];
    }

    public function error() {
        return $this->_error;
    }

    public function count() {
        return $this->_count;
    }

    public function quote($string) {
        return $this->_connection->quote($string);
    }


}