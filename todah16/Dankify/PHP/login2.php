
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['logout'])) {
    $_SESSION["logged in"] = false;
}

if(isset($_POST['submit']) && $_POST['username'] == "John") {
    $username = $_POST['username'];
    echo "Hi $username";
    $_SESSION["logged in"] = true;
}


if(isset($_SESSION["logged in"]) && $_SESSION["logged in"] == true) {
    echo '<form method="post">';
    echo "<input type='submit' value='Log out' name='logout'>";
    echo '</form>'; 
} else {
}