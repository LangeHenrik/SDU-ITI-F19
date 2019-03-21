<?php
require "connection.php";

$username_error = "";
$password_error = "";
$has_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username)) {
        $has_error = true;
        $username_error = "Username is required";
    }
    if (empty($password)) {
        $has_error = true;
        $password_error = "Password required";
    }

    if (!$has_error) {
        /**
         * @var PDO $conn
         */

        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $existingUser = $data[0];
        $password_hash = $existingUser['password'];
        //print_r($existingUser['password']);
        if(password_verify($password, $password_hash)) {
            $id = $existingUser['id'];
            settype($id, 'int');

            session_start();
            $_SESSION["id"] = $id;
            header("Location: /index.php");
        } else {
            $has_error = true;
            $password_error = "Unknown user or password";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Picturest</title>
    <link href="style/login.css" type="text/css" rel="stylesheet">

</head>
<body>
<h1 class="headertitle">Picturest</h1>

<form id="loginPage" style="text-align: center" action="login.php" method="post">
    <div>
        <input class="input" type="text" placeholder="Username" id="usernameinput" name="username">
    </div>
    <div>
        <input class="input" type="password" placeholder="Password" id="userpasswordinput" name="password">
    </div>
    <div>
        <button class="button" type="submit">Take a look</button>
    </div>
    <div>
        <a href="signup.php" class="button">Create account</a>
    </div>
</form>

</body>
</html>