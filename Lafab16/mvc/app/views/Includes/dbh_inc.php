<?php

$server_name = "localhost";
$dB_username = "root";
$dB_password = "";
$dB_name = "lafab16";
$dB_port = "3308";

  $connect = new PDO("mysql:host=$server_name;port=$dB_port;dbname=$dB_name", $dB_username, $dB_password);

//We only need to close the php if we want to include html code
