<?php

// class ServerConn {
  
  $servername = "localhost";
  $username   = "root";
  $userpass   = "1608";
  $dbname     = "itiproj";

	    $conn = new mysqli($servername, $username, $userpass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {  
    } 
// }
?>