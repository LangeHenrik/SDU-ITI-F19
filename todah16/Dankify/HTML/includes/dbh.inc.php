//This file is responsible for handling the connection to the database.

<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "localhost";

try {
    $conn = new PDO("mysql:host=$servername;dbname=localhost", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>