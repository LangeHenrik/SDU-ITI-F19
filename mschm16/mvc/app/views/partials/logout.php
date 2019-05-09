<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="mschm16/mvc/app/assets/css/style.css">
<body>
  
<?php 
$style = "";

error_reporting(E_ALL);

if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
    echo " <p class 'status'>Welcome, " . $_SESSION['userName'] . "</p>";
    echo "<br>";
    $style = "";
    $stylein = "style='display:none;'";
} else {
    session_unset();
    $style = "style='display:none;'";
    echo " <p class = 'status'>Welcome, guest</p> ";
    echo "<br>";
    $stylein = "";
}

if (isset($_POST["logout"])) {
    session_unset();
    $_SESSION['login'] = 0;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/mschm16/mvc/public/index.php" . $location);
}

if (isset($_POST["loginnav"])) {
    session_unset();
    $_SESSION['login'] = 0;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/mschm16/mvc/app/views/home/login.php");
}
?>

<div class = "logbutton" id="button" <?php echo $style;?>>
<form method="post">
    <input type="submit" name="logout" id="logout" value="Log out">
</form>
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