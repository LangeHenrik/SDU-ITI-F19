<?php
    if(isset($_SESSION['ID'])) {
        header('Location: /dpete17/mvc/public/dashboard/');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
     integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
     crossorigin="anonymous">
    <link rel="stylesheet" href="/dpete17/mvc/app/views/main-style.css">
    <script src="/dpete17/mvc/app/views/home/sign-action.js"></script>
    <title>Project A01</title>
</head>
<body>
    <div class="container">
        <header class="main-header">
            <h1>Project A01</h1>
        </header>
        <div class="sign-content">
            <div id="register">
                <form action="home/register" onsubmit="return validateRegisterForm()" method="POST">
                    <div class="input">
                        <label for="username">Username</label>
                        <input id="regUsername" type="text" name="username" value="Hello" onkeyup="validateUsername('regUsername')" required />
                        <label for="password">Password</label>
                        <input id="regPassword" type="password" name="password" value="World1" onkeyup="validatePassword('regPassword')" required />
                        <label for="repeat_password">Repeat Password</label>
                        <input id="regRepeat" type="password" name="repeat_password" value="World1" onkeyup="validateRepeatPassword()" />

                        <label for="firstname"">Firstname</label>
                        <input id="regFirstname" type="text" name="firstname" value="Hello" onkeyup="validateFirstname()" />
                        <label for="lastname">Lastname</label>
                        <input id="regLastname" type="text" name="lastname" value="World" onkeyup="validateLastname()" />

                        <label for="zip"">Zip</label>
                        <input id="regZip" type="text" name="zip" value="6231" onkeyup="validateZip()" />
                        <label for="city">City</label>
                        <input id="regCity" type="text" name="city" value="Odense" onkeyup="validateCity()" />
                        
                        <label for="email">Email</label>
                        <input id="regEmail" type="email" name="email" value="mvc@mvc.dk" onkeyup="validateEmail()"/>
                        <label for="phone">Phone</label>
                        <input id="regPhone" type="text" name="phone" value="23452345" onkeyup="validatePhone()"/>
                    </div>
                    <div class="filler"></div>
                    <div class="button-container"><button type="submit">Register!</button></div>
                    <div class="sign-toggle"><span>Already a user? <a href="javascript:toggle()">Login!</a></span></div>
                </form>
            </div>
            <div id="login" class="hidden">
                <form action="home/login" onsubmit="return validateLoginForm()" method="POST">
                    <div class="input">
                        <label for="username">Username</label>
                        <input id="logUsername" type="text" name="username" value="Admin1" onkeyup="validateUsername('logUsername')" required />
                        <label for="password">Password</label>
                        <input id="logPassword" type="password" name="password" value="Admin1" onkeyup="validatePassword('logPassword')" required />
                    </div>
                    <div class="filler"></div>
                    <div class="button-container"><button type="submit">Login!</button></div>
                    <div class="sign-toggle"><span>Not a member? <a href="javascript:toggle()">Register!</a></span></div>
                </form>
            </div>

            <div style="text-align: center;"><span id="message">
                <p id="errorMessage"></p>
                <?php

                    if(isset($_SESSION['MESSAGE'])) {
                        echo $_SESSION['MESSAGE'];
                        unset($_SESSION['MESSAGE']);
                    }

                ?>
            </span></div>
        </div>

        <?php include('../app/views/partials/main-footer.php'); ?>
    </div>
</body>
</html>