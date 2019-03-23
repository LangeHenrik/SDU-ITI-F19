<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mikkp17";

$conn = new PDO("mysql:host=$servername; dbname=$dbname", $dbusername, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if(!$conn){
	die("Connection failed");
}