<?php
//error_reporting(E_ALL);
//require 'dbmanager.php';
//if (!empty($_POST)) {
//    $theusername = $_POST['username'];
//    $thepassword = $_POST['password'];
//
//    /* First check if username exists in DB*/
//    $dbcheck = checkUserExists($theusername);
//
//    if ($dbcheck) {
//        /* The username exists in the database*/
//        if(checkCredentials($theusername, $thepassword)) {
//            session_start();
//            $_SESSION['login_user'] = $theusername;
//            header('location: index.php');
//        }
//    } else {
//        echo '<script>alert("Username doesn\'t exist, or password is incorrect.")</script>';
//    }
//
//}
//?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Account Login</title>
    <link href="/mifor16/mvc/public/css/mystylesheet.css" type="text/css" rel="stylesheet">

</head>
<body>

<form action="services/login()" method="post">
    <div class="box">

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit" value="Submit">Login</button>
    </div>


</form>

<form action="register.php" method="post">
    <div class="box">
        <button type="submit" value="Submit">Register User</button>
    </div>
</form>


</body>


</html>