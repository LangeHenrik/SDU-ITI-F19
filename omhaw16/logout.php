<!DOCTYPE html>
<html>

<body>
    
<form method="post">
    <input type="submit" name="logout" id="logout" value="Logout"><br/>
</form>

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
    echo " Hello user   " . $_SESSION['userName'] . "  ";
} else {
    session_unset();
  // -- DEBUG --  echo "Login = 0";
    echo " You're logged out! ";
    echo " Hello guest. ";
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

?>

    
</body>
    
</html>