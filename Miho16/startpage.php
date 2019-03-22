<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 20-03-2019
 * Time: 18:53
 */
session_start();
error_reporting(E_ALL);



require 'DB_manager.php';
//LOGIN part

    $un = $_POST['lusername'];
    $pw = $_POST['lpassword'];
if( isset($_POST["lusername"]) ) {
    if (checkUserExist($un)) {
        try {
            if (checkpass($un, $pw)) {
                $_SESSION['username'] = $un;
                header('location: gallery.php');
            } else {
                echo '<scipt>wrong password:</script>';
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo '<scipt>wrong username</script>';

    }
    }

//REGISTER part
$username = $_POST['rusername'];
$password = $_POST['rpassword'];
if( isset($_POST["rusername"]) ) {



    if (checkUserExist($username)) {
        register_to_db($username, $password);
        echo '<script>alert("Username is taken!")</script>';
    } else {
        register_to_db($username, $password);
        echo '<script>alert("Youre signed up!")</script>';
    }


}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Start Page</title>
</head>


<link rel="stylesheet" type="text/css" href="mystyle.css">


<body>

<h1>Welcome please sign up or login</h1>

<sub> login here </sub>

<form method="post" name="login";>
    <label>username:</label>
    <input type="text" placeholder="username" name="lusername">
    <br>
    <label>password:</label>
    <input type="Password" placeholder="password" name="lpassword">
    <br>
    <input type="Submit" id="submit" value="Login">
</form>

<br><br>

<sub> register here </sub>
<form method="post" name="register";>
    username:<label>
        <input type="text" name="rusername" placeholder="username">
    </label><br>
    password: <label>
        <input type="Password" name="rpassword" placeholder = "password">
    </label><br>
    <input type="Submit" value="register">
</form>

</body>

</html>

