<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <link href="/jonasr16/mvc/public/stylesheet.css" type="text/css" rel="stylesheet">
    <script src = "/jonasr16/mvc/public/check.js"></script>
</head>
<body>
<form action= "/jonasr16/mvc/public/Register/register" onsubmit="return checkInputs()" method="post">
    <fieldset>
        <legend>Register</legend>
Username:<br>
        <input type="text" name="username" id="username" required><br>
Password:<br>
        <input type="password" name="password" id="password" required><br>
Repeat Password:<br>
        <input type="password" name="rpassword" id="rpassword" required><br>
Firstname:<br>
        <input type="text" name="firstname" id="firstname" required><br>
Lastname:<br>
        <input type="text" name="lastname" id="lastname" required><br>
Zip:<br>
        <input type="text" name="zip" id="zip" required><br>
City:<br>
        <input type="text" name="city" id="city" required><br>
Email adress:<br>
        <input type="text" name="email" id="email" required><br>
Phone number:<br>
        <input type="text" name="phonenumber" id="number" required><br>
        <br>
        <button class="button buttonregister" type="submit">Register</button>
    </fieldset>

</form>
<?php if (isset($viewbag["password_match"])) {
    echo $viewbag["password_match"];
} ?>
<?php if (isset($viewbag["user_exist"])) {
    echo $viewbag["user_exist"];
} ?>
<div>
    <a href="/jonasr16/mvc/public/Login">Login</a>
</div>
</body>
</html>

