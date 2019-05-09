<?php

// class ServerConn {
  
  $servername = "localhost";
  $username   = "root";
  $userpass   = "";
  $dbname     = "itproject";

	    $conn = new mysqli($servername, $username, $userpass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {  
    } 
// }
?>