<?php include('server.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title> Register page </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type="text/css" href="styles.css" />
    <script src="checker.js"></script>
</head>
    <body>
        <div class="content">
            <h2> Register user </h2>
            <form action="server.php" method=”post” >
                <label for="username"> username</label>
                <br>
                <input type="text" name="username" id="username" required/>
                <br>
                <label for="password">password</label>
                <br>
                <input type="password" name="password1" id="password1" required/>
                <br>
                <label for="password2">repeat password</label>
                <br>
                <input type="password" name="password2" id="password2" onblur="passwordCheck()" required/>
                <br>
                <label for="firstname"> First name</label>
                <br>
                <input type="text" name="firstname" id="firstname" required/>
                <br>
                <label for="lastname"> Last name</label>
                <br>
                <input type="text" name="lastname" id="lastname" required/>
                <br>
                <label for="zip"> zip</label>
                <br>
                <input type="number" name="zip" id="zip" required/>
                <br>
                <label for="city"> city</label>
                <br>
                <input type="text" name="city" id="city" required/>
                <br>
                <label for="email"> Email</label>
                <br>
                <input type="text" id="email" onblur="emailCheck()" required/><label id="emailval"> </label>
                <br>
                <label for="phone"> Phone number</label>
                <br>
                <input type="text" name="phone" id="phone" required/>
                <br>
                <input type="submit" name="submit" id="submit"/>
            </form>
        </div>
        <div class="navbar">
            <a href="index.php"> Login here </a>
            <a href="register.php"> Register </a>
        </div>
    </body>
</html>