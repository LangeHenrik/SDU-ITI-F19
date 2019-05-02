<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="/jonasr16/mvc/public/stylesheet.css" type="text/css" rel="stylesheet">
</head>
<body>
<form action="/jonasr16/mvc/public/Login/login" method="post">
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
    <a href="/jonasr16/mvc/public/Register">Register</a>
</div>
</body>
</html>
