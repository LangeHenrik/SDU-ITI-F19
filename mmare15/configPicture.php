<?php
/**
 * Created by PhpStorm.
 * User: matiasmarek
 * Date: 21/03/2019
 * Time: 12.40
 */

// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbName     = "user";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


?>