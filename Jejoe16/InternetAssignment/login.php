<?php

include("database.php");

        if(!empty($_POST)) {
            $myusername = $_POST['username'];
            $mypassword = $_POST['password'];

            $result = checkUser($myusername, $mypassword);
            $count = count($result);

            if ($count == 1) {
                session_start();
                $_SESSION['login_user'] = $myusername;

                header("location: index.php");
            } else {
                echo "<script> alert(\"Wrong username or password\"); </script>";
            }
        }
?>

<html lang="en">

<head>
    <title>Login Page</title>
    <link href="css/login.css" type="text/css" rel="stylesheet">

</head>
    <body>

<form action="" method = "post">
    <div class="container">

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit" value="Submit">Login</button>
    </div>


</form>

<form action="registerUser.php" method = "post">
    <div class="container">
        <button type="submit" value="Submit">Register User</button>
    </div>
</form>


    </body>




</html>