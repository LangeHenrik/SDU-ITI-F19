<?php
    $serverName = "localhost";
    $connName   = "root";
    $connPass   = "1608";
    $dbname     = "itiproj";
    
    $conn = new mysqli($serverName, $connName, $connPass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {   
    }
?>