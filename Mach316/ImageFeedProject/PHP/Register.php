<?php
session_start();

require 'DatabaseManager.php';

//Use the databasemanger instead of this!

$hostname = '127.0.0.1';
$username = 'root';
$password = 'nqg69yhk';
$db = 'internet_technology';

$dbConnection = mysqli_connect($hostname, $username, $password, $db);



if ($dbConnection->connect_error) {
    die("Database connection failed: " . $dbConnection->connect_error);
}

$firstname = $_POST["firstname"];
$lastname =  $_POST["lastname"];
$password = $_POST["password"];
$username =  $_POST["username"];
$zipcode = $_POST["zip"];
$city = $_POST["city"];
$email = $_POST["email"];
$phonenumber = $_POST["phonenumber"];

$zipcode = (int)$zipcode;


$statement = $dbConnection->prepare("INSERT INTO users(firstname, lastname, username, password, zip, city, email, phonenumber) VALUES(?,?,?,?,?,?,?,?)");
$statement->bind_param('ssssisss', $firstname, $lastname, $username, $password, $zipcode, $city, $email, $phonenumber);

$success = $statement->execute();

if($success) {
    header('Location: http://localhost:8000/PHP/PictureManagement.php?');
} else {
    echo "Something went wrong..";
}