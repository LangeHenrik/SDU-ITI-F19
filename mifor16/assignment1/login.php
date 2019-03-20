<?php
error_reporting(E_ALL);
echo '<script>console.log("Is printed, vry cool")</script>';
?>

<html lang="en">

<head>
    <title>Account Login</title>
    <link href="mystylesheet.css" type="text/css" rel="stylesheet">

</head>
<body>

<form action="" method="post">
    <div class="box">

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit" value="Submit">Login</button>
    </div>


</form>

<form action="register.php" method="post">
    <div class="box">
        <button type="submit" value="Submit">Register User</button>
    </div>
</form>


</body>


</html>