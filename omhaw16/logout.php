<!DOCTYPE html>
<html>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
<body>
  
  <?php $style = ""; ?>

<?php

/* function testfunc()
{
   echo "Your test function on button click is working";
} */

error_reporting(E_ALL);

if(session_status() == PHP_SESSION_NONE) {
    session_start();
  // -- DEBUG --  echo "Session started.  ";
} else { 
  // -- DEBUG --   echo "Session stopped.";
    }


if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
  // -- DEBUG --  echo "login = 1";
  // -- DEBUG --  echo " You're logged in! ";
    echo " <p class 'status'> Hello, " . $_SESSION['userName'] . "!  </p>";
    echo "<br>";
    $style = "";
    $stylein = "style='display:none;'";


} else {
    session_unset();
  // -- DEBUG --  echo "Login = 0";
    
    $style = "style='display:none;'";
    echo " <p class = 'status'> Hello guest! </p> ";
    echo "<br>";
    $stylein = "";

}

/* - DEBUG --

if(isset($_SESSION['login'])) {
    echo "Login session IS SET.";
} else { 
    echo "Login session is NOT set.";
}


if(isset($_SESSION['login']) && $_SESSION['login'] == 1){
    echo "- logged in";



} else if (!isset($_SESSION['login']) && $_SESSION['login'] == 0) {
    echo "You're not logged in";
    // echo "Good bye!"; 
} */


 // And now, we log out:

    if (isset($_POST["logout"])) {
    session_unset();
    $_SESSION['login'] = 0;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/ITICloned/omhaw16" . $location);
    // print_r($_POST["logout"]);
}

    if (isset($_POST["loginnav"])) {
    session_unset();
    $_SESSION['login'] = 0;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/ITICloned/omhaw16/login.php");
    // print_r($_POST["logout"]);
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
</form>
<br>
</div>

    
</body>
    
</html>