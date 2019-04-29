<html>
    <head>
        <link rel="stylesheet" href="header_style.css">
    </head>
    <body>
        <div class = 'login'>
            <a href="index.php"><img src="images/logo.png"></a>
            <p>Welcome Home, </p>
            <?php 
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            echo "<p id='user_name'>" . $_SESSION["user_name"] . "</p";
            
            ?>
        </div>
    </body>

</html>

<?php


if(isset($_POST['home'])) {
    header('Location: register.php', true, 302);
    echo 'Yooooooo!';
    die();
}