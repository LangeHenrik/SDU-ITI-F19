<!DOCTYPE html>
<html>
    <head>
        <title>Login Succeeded!</title>
    </head>
    <body>
        <?php include 'top.php' ?>
        <div id="content">
            <br><br>    
            <h1 style="color: green">Logged in!</h1>
            <p>You have entered correct user credentials! <br> You'll be taken to front page.<br><br> Please wait...</p>
        </div>
        <?php
            header("Refresh: 1; url=index.php");
        ?>
    </body>
</html>
