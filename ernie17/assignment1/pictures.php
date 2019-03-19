<?php
    # Starty session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    # Check login
    if(isset($_POST["logout"])) {
        header('location: index.php');
        session_destroy();
    }

    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        @$_SESSION['page_name'] = "Pictures";
    } else {
        echo "No user is currently logged in!";
        return;
    }

    include 'userLogin.php';

?>

<html>
    <head>
        <title>Assignment 1</title>
        <meta name="viewport" content="width=device-witdh, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php'; ?>

        <?php include 'footer.php'; ?>
    </body>
</html>
