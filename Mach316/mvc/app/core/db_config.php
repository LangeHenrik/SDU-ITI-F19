<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-12
 * Time: 19:28
 */

if (!function_exists('getConnection')) {

    function getConnection()
    {

        $hostname = '127.0.0.1';
        $username = 'root';
        $password = 'root';
        $db = 'mach316';
        $port = 3306;
        $dsn = "mysql:dbname={$db};host={$hostname};port={$port};charset=utf8";


        try {
            $conn = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            die("AWTFCONN failed: " . $e->getMessage());
        }
        return $conn;
    }
}