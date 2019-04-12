<?php
require(__DIR__.'/../Model/userDAO.php');
require_once(__DIR__.'/../Model/entities/user.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="/CSS/main.css">
    <link rel="stylesheet" type="text/css" href="/CSS/users.css">
</head>
<body>

<div class="container">
    <?php include(__DIR__.'/Components/NavigationBar.php'); ?>

    <div class="">
        <h1> We build on trust!</h1>
        <center><h3>Forgot your password? No problem. Find it here</h3></center>
    </div>

    <br/>
    <br/>

    <div class="user">
        <div class="user__username"> <b>Username</b> </div>
        <div class="user__username"><b> Password</b> </div>
        <br/>
    </div>

    <?php

    $users = getAllUsers();
    foreach($users as $user) {
        echo '<div class="user">';
        echo '<div class="user__username">' . $user->username .'</div>';
        echo '<div class="user__password">' . $user->password .'</div>';
        echo '</div>';
    }
    ?>

</div>

</body>
</html>