<?php

$hostname = '127.0.0.1';
$username = 'root';
$password = 'nqg69yhk';
$db = 'internet_technology';

$dbconnect = mysqli_connect($hostname, $username, $password, $db);

if ($dbconnect->connect_error) {
    die("Database connection failed: " . $dbconnect->connect_error);
}

$reqpassword = $_POST["password"];
$requsername = $_POST["username"];


$query = mysqli_query($dbconnect, "SELECT * FROM users;")
or die (mysqli_error($dbconnect));

$usernameMatch = false;
$userpasswordMatch = false;


while ($row = mysqli_fetch_array($query)) {

    $rowusername = $row["username"];
    $rowpassword = $row["password"];
    $rowid = $row["id"];

    if ($rowusername == $requsername) {
        $usernameMatch = true;

        if ($rowpassword == $reqpassword) {
            session_start();
            $_SESSION["username"] = $requsername;
            $_SESSION["id"] = $rowid;
            header('Location: http://localhost:8000/PHP/Feed.php?');
        }

    }




}
