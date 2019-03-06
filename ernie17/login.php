<form method="post">
    <input type="text" name="user">
    <input type="password" name="password">
    <input type="submit" >
</form>

<?php
    if($_POST["user"] === "Henrik" && $_POST["password"] === "Lange") :
        $GLOBAL["username"] = $_POST["user"];
        header('location: userpage.php');
    endif
?>