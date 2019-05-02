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

<script type="text/javascript">

    function checkForm(form)
    {
        if(form.rusername.value == "") {
            alert("Error: Username cannot be blank!");
            form.username.focus();
            return false;
        }
        re = /^\w+$/;
        if(!re.test(form.rusername.value)) {
            alert("Error: Username must contain only letters, numbers and underscores!");
            form.username.focus();
            return false;
        }

        if(form.rpassword.value != "" && form.rpassword.value == form.rpassword2.value) {
            if(form.rpassword.value.length < 6) {
                alert("Error: Password must contain at least six characters!");
                form.rpassword.focus();
                return false;
            }

            re = /[0-9]/;
            if(!re.test(form.rpassword.value)) {
                alert("Error: password must contain at least one number (0-9)!");
                form.rpassword.focus();
                return false;
            }
            re = /[a-z]/;
            if(!re.test(form.rpassword.value)) {
                alert("Error: password must contain at least one lowercase letter (a-z)!");
                form.rpassword.focus();
                return false;
            }
            re = /[A-Z]/;
            if(!re.test(form.rpassword.value)) {
                alert("Error: password must contain at least one uppercase letter (A-Z)!");
                form.rpassword.focus();
                return false;
            }
        } else {
            alert("Error: Please check that you've entered and confirmed your password!");
            form.rpassword.focus();
            return false;
        }

        alert("You entered a valid password: " + form.rpassword.value);
        return true;
    }

</script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Start Page</title>
</head>



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
<form method="post" name="register"  onsubmit="return checkForm(this);">
    username:<label>
        <input type="text" name="rusername" placeholder="username">
    </label><br>
    password: <label>
        <input type="Password" name="rpassword" placeholder = "password" id="rpassword">
        <input type="Password" name="rpassword2" placeholder = "password" id="rpassword2">

    </label>
    <br>
    <input type="Submit" value="register">
</form>

</body>

</html>



