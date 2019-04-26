<?php
$servername = "localhost";
$username = "root";
$password = "pass";
$dbname = "gunob17";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
