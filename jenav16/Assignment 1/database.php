<?php
require "db_config.php";

    $conn = new PDO("mysql:host=$SERVER;dbname=$DATABASE", $USER, $PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


