<?php
    $serverName = "localhost";
    $connName   = "root";
    $connPass   = "1608";
    $dbname     = "itiproj";
    // $port = "8889"
    // Create connection
    $conn = new mysqli($serverName, $connName, $connPass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {   
    }

    //Close the connection when u want
    //$conn->close();
?>