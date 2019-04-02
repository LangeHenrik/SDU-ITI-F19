<?php
require 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My page</title>
    <link rel="stylesheet" type="text/css" href="General.css">
</head>
<body>
<div class="container">
    <div id="navbar"></div>
    <div>

        <div class="feed__caption">
            <h1> We build on trust!</h1>
            <p>Forgot your password? No problem. Find it here</p>
        </div>

        <br/>
        <br/>

        <div class="user">
            <div class="user__username"> <b>Username</b> </div>
            <div class="user__username"><b> Password</b> </div>
            <br/>
        </div>
        <?php


        $users = getAllUsers($conn);
        foreach($users as $user) {
            echo '<div class="user">';
            echo '<div class="user__username">' . $user['username'] .'</div>';
            echo '<div class="user__password">' . $user['password'] .'</div>';
            echo '</div>';
        }

        ?>


    </div>

</div>


<script src="navbar.js"></script>
</body>
</html>
