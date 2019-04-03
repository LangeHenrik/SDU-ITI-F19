<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chhoe17";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


}
catch(PDOException $e) {
	echo $e->getMessage();
}


