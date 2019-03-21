<?php
    $serverName = "localhost";
    $userName   = "root";
    $password   = "";
    $dbname     = "itproject";

    // Create connection
    $conn = new mysqli($serverName, $userName, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";

    //Close the connection when u want
    //$conn->close();
?> 