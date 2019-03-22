<?php
    # Starty session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        echo "No user is currently logged in!";
        return;
    }
?>

<footer>
    <div class="footer">
        <form method='post'>
            <button name='logout' id="btn-logout">Log out</button>
        </form>
    </div>
</footer>
