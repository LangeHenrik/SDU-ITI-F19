<?php
session_start();

if(isset($_GET['logout'])) {
    $_SESSION['username'] = NULL;
    echo "Successfully logged out.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Awesome Website</title>
</head>
<body>

<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "Hello $username!";
    echo '<a href="?logout=1">Click here to log out</a>';
} else {
    echo '<a href="./signup.php">Click here to sign up</a>
<br>
<a href="./login.php">Click here to log in</a>';
}

?>

</body>
</html>
