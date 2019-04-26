<?php
require_once(__DIR__.'/../Model/userDAO.php');
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
        <h1> All users in system</h1>
    </div>

    <br/>
    <br/>

    <div class="user">
        <div class="user__username"> <b>Username</b> </div>
        <div class="user__username"><b> ID </b> </div>
        <br/>
    </div>

    <?php

    $users = getAllUsers();
    foreach($users as $user) {
        echo '<div class="user">';
        echo '<div class="user__username">' . $user->username .'</div>';
        echo '<div class="user__password">' . $user->user_id .'</div>';
        echo '</div>';
    }
    ?>

</div>

</body>
</html>