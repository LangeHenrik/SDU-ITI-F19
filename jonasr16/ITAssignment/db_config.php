<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 20-03-2019
 * Time: 10:23
 */

function getConnection()
{
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'database';
    $port = 3306;
    $dsn = "mysql:dbname={$db};host={$hostname};port={$port};charset=utf8";
    try {
        $conn = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    return $conn;
}

