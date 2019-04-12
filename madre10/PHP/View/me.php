<?php
require_once(__DIR__ . './Components/RequireLogin.php');
require_once(__DIR__ . '/../Model/userDAO.php');
$user = getUserById($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your page</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<div class="container">
    <?php include(__DIR__ . '/Components/NavigationBar.php'); ?>

    <h1> My page </h1>
    <p> Firstname: <?= $user["firstname"]?></p>
    <p> Lastname: <?= $user["lastname"]?></p>
    <p> Username: <?= $user["username"]?></p>
    <p> Zip: <?= $user["zip"]?></p>
    <p> City: <?= $user["city"]?></p>
    <p> Email: <?= $user["email"]?></p>
    <p> Phone: <?= $user["phone"]?></p>


</div>

</body>
</html>