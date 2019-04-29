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

<header>
    <span class="header-title"><?php echo $_SESSION['page_name'] . " - $firstname $lastname" ?></span>
    <nav>
        <ul>
            <li><a href="pictures.php">Pictures</a></li>
            <li><a href="upload.php">Upload</a></li>
            <li><a href="users.php">Users</a></li>
        </ul>
    </nav>
</header>
