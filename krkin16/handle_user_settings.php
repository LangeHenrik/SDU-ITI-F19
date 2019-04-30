

<?php
    if(isset($_POST['log_out'])) {
        unset($_SESSION['user_name']);
    }
    if(isset($_POST['home'])) {
        header('Location: index.php', true, 302);
    }
    if(isset($_POST['my_images'])) {
        header('Location: index.php?user_images=' . $_SESSION["user_name"], true, 302);
    }

    if(isset($_GET["user_images"])) {
        echo "<p id = 'query_style'>" . $_GET["user_images"] . "</p>";
    }
?>