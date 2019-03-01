<?php
session_start();
require 'database.php';
if( isset($_SESSION['user_id']) ){
    $records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = NULL;
    if( count($results) > 0){
        $user = $results;
    }
}
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

        <?php if( !empty($user) ): ?>

            <br />Welcome <?= $user['email']; ?>
            <br /><br />You are successfully logged in!
            <br /><br />
            <a href="logout.php">Logout?</a>

        <?php else: ?>

            <h1>Please Login or Register</h1>
            <a href="login.php">Login</a> or
            <a href="register.php">Register</a>

        <?php endif; ?>



    </div>

</div>


<script src="navbar.js"></script>
</body>
</html>