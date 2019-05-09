<?php 

include dirname(__DIR__) . '/views/partials/navi.php';
include dirname(__DIR__) . '/views/partials/logout.php';

$loggedin = 0;
$loginuser = "";
$loginpass = "";
$usernameErr = "";
$userID = '';

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
    echo "<br>";
    $stylereg = "style='display:none;'";
    echo " <p class = 'success'> You're already logged in. </p>";
    $userID = $_SESSION['userID'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginuser = $_POST["user"];
    $loginpass = $_POST["pw"];

    if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["user"])) {
        $usernameErr = "User name contains illegal characters!";
        $regexcheck = 0;
    }  
    
    $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
    require $pathroot . '/mschm16/mvc/app/core/serverconn.php';
    
    $sql = "SELECT userId FROM users WHERE userName = '$loginuser' AND userPass = '$loginpass'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    $userID = $row['userId'];
    $count = mysqli_num_rows($result);
    
    if ($count == 1) {
        echo "Welcome to the site";
        header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/mschm16/mvc/public/index.php" . $location);
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['userID'] = $row["userId"];
        $_SESSION['userName'] = $loginuser;
        $_SESSION['password'] = $loginpass;
        $_SESSION['login'] = 1;
        $conn->close();

    } else if ($count == 0) {    
        echo "<p class = 'status'>Username and password do not match. </p>";
    } else { 
        echo "An error was encountered while passing data to database! The error was: " . $conn->error . "while calling SQL method: " . $sql;
    }

    if (!isset($_SESSION['login'])) { 
        echo " Welcome guest.";
    } else { 
        echo " Welcome user.";
    } 
}
?>