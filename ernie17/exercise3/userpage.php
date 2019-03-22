<?php
    session_start();
    
    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        echo "<h1>Welcome " . $_SESSION['username'] . "</h1>";
        echo   "<form method='post'>
                <button name='logout'>Log out</button>
                </form>";
        
        if(isset($_POST["logout"])) {
            header('location: index.php');
            session_destroy();
        }
    } else {
        echo "No user is currently logged in!";
    }
