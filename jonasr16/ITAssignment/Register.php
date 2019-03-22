<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 20-03-2019
 * Time: 09:23
 */

require "db_manager.php";

$nothing_wrong_here_buddy = true;
$password_match = true;
$user_exist = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $phonenumber = $_POST["phonenumber"];


    if($password != $rpassword){
        $password_match = false;
    } else {
        if(create_user($username, $password, $firstname, $lastname, $zip, $city, $email, $phonenumber) == false){
            header("location: Login.php");
        } else {
            $user_exist = true;
        }

    }
}



?>
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <link href="stylesheet.css" type="text/css" rel="stylesheet">
</head>
<body>
<form action= "" method="post">
    <fieldset>
        <legend>Register</legend>
Username:<br>
        <input type="text" name="username" required><br>
Password:<br>
        <input type="password" name="password" required><br>
Repeat Password:<br>
        <input type="password" name="rpassword" required><br>
Firstname:<br>
        <input type="text" name="firstname" required><br>
Lastname:<br>
        <input type="text" name="lastname" required><br>
Zip:<br>
        <input type="text" name="zip" required><br>
City:<br>
        <input type="text" name="city" required><br>
Email adress:<br>
        <input type="text" name="email" required><br>
Phone number:<br>
        <input type="text" name="phonenumber" required><br>
        <br>
        <button class="button buttonregister" type="submit">Register</button>
    </fieldset>

</form>
<?php
if ($password_match == false){
    echo "Password does not match";
    $password_match = true;
}
if ($user_exist == true){
    echo "The user already exist";
    $user_exist = false;
}
?>
<nav>
    <ul>
        <li><a href="Login.php">Login</a></li>
    </ul>
</nav>
</body>
</html>

