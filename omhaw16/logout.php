<!DOCTYPE html>
<html>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
<body>
  
  <?php $style = ""; ?>

<?php

error_reporting(E_ALL);

if(session_status() == PHP_SESSION_NONE) {
    session_start();
  
}


if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
    echo " <p class 'status'> Hello, " . $_SESSION['userName'] . "!  </p>";
    echo "<br>";
    $style = "";
    $stylein = "style='display:none;'";


} else {
    session_unset();
    $style = "style='display:none;'";
    echo " <p class = 'status'> Hello guest! </p> ";
    echo "<br>";
    $stylein = "";

}

 // And now, we log out:

    if (isset($_POST["logout"])) {
    session_unset();
    $_SESSION['login'] = 0;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/ITICloned/omhaw16" . $location);
}

    if (isset($_POST["loginnav"])) {
    session_unset();
    $_SESSION['login'] = 0;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/ITICloned/omhaw16/login.php");
}

?>

<div class = "logbutton" id="button" <?php echo $style;?>>
<form method="post">
    <input type="submit" name="logout" id="logout" value="Log out">
</form>
<br>
</div>

<div class = "logbutton" id="button" <?php echo $stylein;?>>
<form method="post">
    <input type="submit" name="loginnav" id="loginnav" value="Log in">
    <hr>
</form>
<br>
</div>

    
</body>
    
</html>