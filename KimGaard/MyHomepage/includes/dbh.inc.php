<?php

$servername = "127.0.0.1";
$dBUsername = "root";
$dBPassword = "";
$dBName = "kinoe16";
$dBPort = "3306";

  $connect = new PDO("mysql:host=$servername;port=$dBPort;dbname=$dBName", $dBUsername, $dBPassword);
