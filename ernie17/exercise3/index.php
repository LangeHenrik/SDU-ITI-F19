<form method="post">
    <input type="text" name="user">
    <input type="password" name="password">
    <input type="submit" >
</form>

<?php
    if(isset($_POST["user"]) && isset($_POST["password"])) {
        if($_POST["user"] === "Henrik" && $_POST["password"] === "Lange") {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["username"] = $_POST["user"];
            $_SESSION["login"] = true;
            header('location: userpage.php');
        } else {
            echo "Wrong username og password!";
        }
    }
?>