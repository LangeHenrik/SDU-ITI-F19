<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<?php
if (isset($data) && count($data) > 0) {
    print_r($data);
}
?>
<form action="/login" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <br>

    <button>Login</button>
</form>
</body>
</html>