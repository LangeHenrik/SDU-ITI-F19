<?php

session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Coiny|Indie+Flower" rel="stylesheet">

    <script src="../JS/Feed.js"></script>
    <script src="../JS/navbar.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/Users.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Navbar.css">
    <link rel="stylesheet" type="text/css" href="../CSS/General.css">

    <meta charset="UTF-8">
    <title>Image Feed</title>
</head>

<body>


<?php

require 'UserLoader.php';


if (isset($_SESSION["username"])) {
    echo "<navbar id=\"navbar\"><a class=\"navbar-link\" href=\"LoginPage.php\">Profile</a></navbar>";
} else {
    echo "<navbar id=\"navbar\"><a class=\"navbar-link\" href=\"LoginPage.php\">Register</a></navbar>";
}

$userElements = loadUserElements();

echo "

<div class=\"page-container\">
    <div class=\"main-content\" id=\"main-content-users\">
        <h1 class='users-header'>Users</h1>
        <div class='users-container'>{$userElements}</div>
       </div>
</div>
"


?>


</body>

</html>