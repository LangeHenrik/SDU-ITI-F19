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
    $username_stripped = strip_tags($username,"<b>");
    $password_stripped = strip_tags($password,"<b>");
    $rpassword_stripped = strip_tags($rpassword,"<b>");
    $firstname_stripped = strip_tags($firstname,"<b>");
    $lastname_stripped = strip_tags($lastname,"<b>");
    $zip_stripped = strip_tags($zip,"<b>");
    $city_stripped = strip_tags($city,"<b>");
    $email_stripped = strip_tags($email,"<b>");
    $phonenumber_stripped = strip_tags($phonenumber,"<b>");


    if($password_stripped != $rpassword_stripped) {
        $password_match = false;
    } else {
        if(create_user($username_stripped, $password_stripped, $firstname_stripped, $lastname_stripped, $zip_stripped,
                $city_stripped, $email_stripped, $phonenumber_stripped) == false){
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
    <script src = "check.js"></script>
</head>
<body>
<form action= "" onsubmit="return checkInputs()" method="post">
    <fieldset>
        <legend>Register</legend>
Username:<br>
        <input type="text" name="username" id="username" required><br>
Password:<br>
        <input type="password" name="password" id="password" required><br>
Repeat Password:<br>
        <input type="password" name="rpassword" id="rpassword" required><br>
Firstname:<br>
        <input type="text" name="firstname" id="firstname" required><br>
Lastname:<br>
        <input type="text" name="lastname" id="lastname" required><br>
Zip:<br>
        <input type="text" name="zip" id="zip" required><br>
City:<br>
        <input type="text" name="city" id="city" required><br>
Email adress:<br>
        <input type="text" name="email" id="email" required><br>
Phone number:<br>
        <input type="text" name="phonenumber" id="number" required><br>
        <br>
        <button class="button buttonregister" type="submit">Register</button>
    </fieldset>

</form>
<?php
if (!$password_match){
    echo "Password does not match";
    $password_match = true;
}
if ($user_exist){
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

