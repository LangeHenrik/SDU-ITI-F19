<?php
require 'util/logincheck.php';
require 'database.php';

if( isset($_SESSION['user_id']) ){
    $records = $conn->prepare('SELECT firstname, lastname, email FROM users WHERE id = :id');
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

            <h1> Welcome <?= $user['firstname']; ?>!</h1>
            <div class="option"><a href="logout.php">Logout?</a></div>


        <?php else: ?>

            <h1>You have to log in..</h1>
            <div class="option">
                <a href="login.php">Login</a>
            </div>
            <div class="option">
                <a href="register.php">Register</a>
            </div>


        <?php endif; ?>



    </div>

</div>


<script src="navbar.js"></script>
</body>
</html>