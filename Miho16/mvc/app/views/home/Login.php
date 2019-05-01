<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 01-05-2019
 * Time: 15:41
 */
?>
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="/Miho16/mvc/public/stylesheet.css" type="text/css" rel="stylesheet">
</head>
<body>
<form action="/Miho16/mvc/public/Login/login" method="post">
    <fieldset>
        Username (a):<br>
        <input type="text" name="username" required><br>
        Password (b):<br>
        <input type="password" name="password" required>
        <br>
        <br>
        <button class="button buttonlogin">Login</button>
        <?php if (isset($viewbag["error_msg"])) {
            echo $viewbag["error_msg"];
        } ?>
    </fieldset>
</form>
<div>
    <a href="/Miho16/mvc/public/Register">Register</a>
</div>
</body>
</html>
