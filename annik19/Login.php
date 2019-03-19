<?php
session_start();
require_once "config.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Login</title>
</head>
<body>

<form class="login" method="post" onsubmit="return validate()">
    <h1>Login</h1>
    <input name="db_username" type="text" class="field_login" placeholder="Username"/>
    <i class="fas fa-user"></i>
    <input name="db_password" type="password" class="field_login" placeholder="Password" />
    <i class="fas fa-unlock"></i>
    <p id="message"></p>
    <input type="submit" id="login_button" value="Login">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["db_username"];
        $db_pwd = $_POST["db_password"];
        //echo $name. " ".$db_pwd ."<br>";
        $sql = 'SELECT username, pwd FROM user WHERE username="' .
            $name . '";';
        //echo $sql . "<br>";
        $stmt = $conn -> prepare($sql);
        $stmt  -> execute();
        $result = $stmt -> fetch(PDO::FETCH_NUM);
        //echo $result[0]." ". $result[1]." ";
        if ($result[0]===$name && password_verify($db_pwd, $result[1])){
            $_SESSION['user'] = $name;
            header("Location:Images.php");
        }else{
            print '<br> <div class="login_error">Wrong username or password</div>';
        }
    }
    ?>
    <p style="font-size: larger">First time here? <a href="Register.php">Register here!</a></p>
</form>


</body>
</html>