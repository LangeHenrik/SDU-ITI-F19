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
    echo "Session started.  ";
} else { 
    echo "Session stopped.";
    }


if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
    echo "login = 1";
    echo "    You're logged in! Hello user   " . $_SESSION['userName'] . "  ";
} else {
    session_unset();
    echo "Login = 0";
    echo "    You're logged out! Hello guest.   ";
}

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
}


 // this part logs you out

    if (isset($_POST["logout"])) {
    session_unset();
    $_SESSION['login'] = 0;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/ITIProjCloned" . $location);
    // print_r($_POST["logout"]);
}

?>

    
</body>
    
</html>