<?php
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
?>