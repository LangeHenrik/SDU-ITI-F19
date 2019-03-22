<?php // location of the php.ini file is /etc/php/7.2/cli  ?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title> Login page </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type="text/css" href="styles.css" />
    <script src="checker.js"></script>
</head>
<body>
<div class="content">
    <h2> Login </h2>
    <form action="server.php" method="post">
        <?php include('errors.php') ?>
        <label for="username" >username</label>
        <br>
        <input type="text" name="username" id="username" required/>
        <br>
        <label for="password">password</label>
        <br>
        <input type="password" name="password" id="password" required/>
        <br>
        <label for="loginlabel" id="loginlabel" color="red"> </label>
        <br>
        <input type="button" name="login" id="submit" onclick="loginCheck();"> </input>
    </form>
</div>
<div class="navbar">
    <a href="index.php"> Login here </a>
    <a href="register.php"> Register </a>
</div>
</body>
</html>
