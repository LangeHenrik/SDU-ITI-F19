<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 20-03-2019
 * Time: 11:10
 */
require "db_manager.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(login($username, $password) == true){
        session_start();
        $_SESSION['login_user'] = $username;
        header("location: picture_page.php");
    } else {
        echo '<script>alert("Username does not exist, or password is incorrect.")</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="stylesheet.css" type="text/css" rel="stylesheet">
</head>
<body>
<form action= "" method="post">
    <fieldset>
        Username:<br>
        <input type="text" name="username" required><br>
        Password:<br>
        <input type="text" name="password" required>
        <br>
        <br>
        <button class="button buttonlogin">Login</button>
    </fieldset>
</form>
<nav>
    <ul>
        <li><a href="Register.php">Register</a></li>
    </ul>
</nav>
</body>
</html>
