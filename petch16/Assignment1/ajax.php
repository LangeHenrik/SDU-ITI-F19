<?php

require_once "config.php";

$data = array();

//create connection and select DB
$db = $link;
if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}

//get user data from the database
$query = $db->query("SELECT id, username, created_at, firstname, lastname, zip, city, email, phonenumber FROM users");

if($query->num_rows > 0){
    $userData = $query->fetch_assoc();
    $data['status'] = 'ok';
    $data['result'] = $userData;
}else{
    $data['status'] = 'err';
    $data['result'] = '';
}

//returns data as JSON format
echo json_encode($data);

?>
