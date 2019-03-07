<?php

$DB_server = "localhost";
$DB_username = "root";
$DB_password = "iMN13ls3n1081";
$DB_name = "loginsys";
//phpinfo();

// Connects to database
//$link = mysqli_connect($DB_server, $DB_username ,$DB_password, DB_name);
// $connection = mysqli_connect("localhost", "user",'',"loginsys");
//

try {
    $conn = new PDO("mysql:host=$DB_server;DB_name=myDB", $DB_username, $DB_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
