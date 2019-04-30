<?php
  $servername = "localhost";
  $username = "root";
  $password = "strong";
  $dbname = "frfab17";
  
  $con = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if(!$con){
	die("Connection failed");
}