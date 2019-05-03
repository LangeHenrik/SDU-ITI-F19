<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/omhaw16/mvc/app/views/styling/style.css">
        <title> Login </title>
        <meta charset="utf-8"/>
        <link rel="shortcut icon" type="image/png" href="/omhaw16/mvc/app/views/styling/favicon.png"/>
    </head>
<body>

	<?php $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);?>     
    <?php include $pathroot . '/omhaw16/mvc/app/controllers/login.php';?>
    
<h1> PhotoPost - Login </h1>

<p class = 'tagline'> - Your photo-sharing website </p>

    <div class = "login" <?php echo $stylelog;?>>
    <form name ="loginform" action="#" method="post">
    <label for="name" style="color: white;">Name</label>
    <br> 
    <input type="text" name="user" id="user"/> 
    <br>
    <span class="error"><?php echo $usernameErr;?></span>
    <br>
    <label for="password">Password</label>
    <br> 
    <input type="password" name="pw" id="pw"/> 
    <br>
    <br>
    <input type="submit" name="submit" id="submit"/>
    <br>
    <p> Not registered yet? Click <a href="/omhaw16/mvc/app/controls/registeruser.php">here!</a> </p>
</div>
</form>

    
</body>
</html>