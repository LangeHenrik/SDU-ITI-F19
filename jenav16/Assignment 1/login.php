<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ITI 1.0</title>
</head>
<body>
<?php
require "database.php";
require "db_config.php";


if (isset($POSTLOGIN)) {
    validateLoginInput($POSTUSERNAME, $POSTPASSWORD);

    $stmt = $conn->prepare("SELECT username,password,firstName FROM Users WHERE username = :username");
    $stmt->bindParam(":username", $POSTUSERNAME);
    $stmt->execute();
    $executed = $stmt->fetchAll();

    if ($executed && password_verify($POSTPASSWORD, $executed[0]['password'])) {
        $_SESSION['username'] = $POSTUSERNAME;
        echo "Hello " . $executed[0]["firstName"];
        header('location: ./');

    } else {
        echo "Wrong username or password mate<br>";
        echo "<button onclick='window.history.back()'>Try again</button>";
    }
}
if (isset($POSTLOGOUT)) {
    session_destroy();
    header('location: ./');
}

function validateLoginInput($POSTUSERNAME, $POSTPASSWORD)
{
    $userRegex = "/^[a-z0-9_-]*$/i";
    $passRegex = "/^(?=.*\d).{8,}$/";

    if (!preg_match($userRegex, $POSTUSERNAME)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die("Username: " . $POSTUSERNAME . " contains illegal characters");
    }
    if (!preg_match($passRegex, $POSTPASSWORD)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die("Password must contain 8 characters and at least 1 number");
    }
}

?>
</body>
</html>
