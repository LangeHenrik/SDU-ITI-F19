<!--This file is responsible for handling the connection to the database.-->

<?php

$servername = "localhost:3307";
$dbUsername = "root";
$dbPassword = "wshHi95j7krfjLpm";
$dbName = "dankify";

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



