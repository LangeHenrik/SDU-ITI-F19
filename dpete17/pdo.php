<?php

    include('db_config.php');
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password, 
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

?>