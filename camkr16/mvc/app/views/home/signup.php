<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Picturest</title>
    <link href="/camkr16/mvc/public/style/login.css" type="text/css" rel="stylesheet">

</head>
<body>
<h1 class="headertitle">Picturest</h1>

<form id="loginPage" style="text-align: center" action="signup" method="post">
    <div>
        <input class="input" type="text" placeholder="Username" id="usernameInput" name="username">
        <?php
        if ($e = $viewbag["username_error"]) {
            echo '<span class="error">' . $e . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="password" placeholder="Password" id="userPasswordInput" name="password">
        <?php
        if ($e = $viewbag["password_error"]) {
            echo '<span class="error">' . $e . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="password" placeholder="Repeat password" id="repeatPasswordInput"
               name="repeatPassword">
        <?php
        if ($e = $viewbag["repeatPassword_error"]) {
            echo '<span class="error">' . $e . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="text" placeholder="Firstname" id="firstnameinput" name="firstname">
        <?php
        if ($e = $viewbag["firstname_error"]) {
            echo '<span class="error">' . $e . "</span>";
        }
        ?>
        <input class="input" type="text" placeholder="Lastname" id="lastnameinput" name="lastname">
        <?php
        if ($e = $viewbag["lastname_error"]) {
            echo '<span class="error">' . $e . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="text" placeholder="Zip" id="zipinput" name="zip">
        <?php
        if ($e = $viewbag["zip_error"]) {
            echo '<span class="error">' . $e . "</span>";
        }
        ?>
        <input class="input" type="text" placeholder="City" id="cityinput" name="city">
        <?php
        if ($e = $viewbag["city_error"]) {
            echo '<span class="error">' . $e . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="text" placeholder="E-mail" id="emailinput" name="email">
        <?php
        if ($e = $viewbag["email_error"]) {
            echo '<span class="error">' . $e . "</span>";
        }
        ?>
    </div>
    <div>
        <input class="input" type="text" placeholder="Phone" id="phoneinput" name="phone">
        <?php
        if ($e = $viewbag["phone_error"]) {
            echo '<span class="error">' . $e . "</span>";
        }
        ?>
    </div>
    <div>
        <button class="button" type="submit">Create account</button>
    </div>
    <div>
        <a href="/camkr16/mvc/public/authentication/login" class="button">Already have an account?</a>
    </div>
</form>

</body>
</html>