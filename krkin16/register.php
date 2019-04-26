<html>
    <head>
        <link rel="stylesheet" href="login_style.css">
        <meta name="viewport" content = "width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class = 'register'>
            <h1>Register User</h1>
            <form method="post" onsubmit="return validateForm()">
                <div class="input">
                    <p>Username:</p>
                    <input type="text" name="login" value="" id="login" required>
                    <p>Password:</p>
                    <input type="password" name="password" value="" id="password required">
                    <p>Confirm Password:</p>
                    <input type="password" name="password_confirm" value="" id="password_confirm" required>


                    <p>First Name:</p>
                    <input type="text" name="first_name" value="" id="first_name" required>
                    <p>Last Name:</p>
                    <input type="text" name="last_name" value=""id="last_name" required>
                    <p>Zip:</p>
                    <input type="text" name="zip" value="" id="zip" required>
                    <p>City:</p>
                    <input type="text" name="city" value="" id="city" required>
                    <p>Email:</p>
                    <input type="text" name="email" value="" id="email" required>
                    <p>Phone:</p>
                    <input type="text" name="phone" value="" id="phone" required>
                </div>
                <input type="submit" name="submit" value="Register!" id="register_button">
            </form>
        </div>
        <script src="validate_registration.js"></script>
    </body>

</html>

<?php
require "database.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['submit'])) {
    $username = $_POST['login'];
    $password = $_POST['password'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    registerUser($username, $password, $firstName, $lastName, $zip, $city, $email, $phone);
    
    
    $authenticated = authenticate($username, $password);
    
    
    if($authenticated) {
        header('Location: login.php', true, 302);
        die();
    }
}


if(isset($_SESSION["user_name"]) && $_SESSION["user_name"] == true) {
    echo '<form method="post">';
    echo "<input type='submit' value='Log out' name='logout'>";
    echo '</form>'; 
} else {
}