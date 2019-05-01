<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:37
 */
namespace core;
use PDO;
use PDOException;

class DB_Config
{
    protected $servername = 'localhost';
    protected $username = 'root';
    protected $password = '84afa43d43';
    protected $dbname = 'miho16';
}
function connect()
{
    $hostname = '127.0.0.1';
    $username = 'root';
    $password = '84afa43d43';
    $db = 'miho16';
    $port = 3306;
    $dsn = "mysql:dbname={$db};host={$hostname};port={$port};charset=utf8";
    try {
        $conn = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    return $conn;
}
