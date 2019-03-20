<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ITI 1.0</title>
</head>
<body>

<?php
require "db_config.php";
require "database.php";

if (isset($POSTSIGNUP)) {

    validateRegisterInput($POSTUSERNAME, $POSTPASSWORD, $POSTPASSWORD2, $POSTFIRSTNAME, $POSTLASTNAME, $POSTZIP, $POSTCITY, $POSTEMAILADRESS, $POSTPHONENUMBER);

    //HASH THIS BAD-BOY
    $hash = password_hash($POSTPASSWORD, PASSWORD_DEFAULT);

    //Pulls all usernames that's equal to POSTUSERNAME (Hopefully none...Fingers crossed)
    $stmt = $conn->prepare("SELECT username FROM Users WHERE username = :username");
    $stmt->bindParam(":username", $POSTUSERNAME);
    $stmt->execute();
    $executed = $stmt->fetchAll();

    //Checks if the username already exists in the database
    if ($executed != null) {
        //TODO Do we really need this?
        echo "Please choose a different username.<br>";
        //TODO NAVIGATE TO FRONTPAGE
        echo "<a href='./'>Click here to go to your feed</a>";
    } else {
        //Else create a new user
        $stmt = $conn->prepare("INSERT INTO Users (username,password,firstName,lastName,zip,city,emailAddress,phoneNumber,date) values (:username,:password,:firstName,:lastName,:zip,:city,:emailAddress,:phoneNumber,NOW())");
        $stmt->bindParam(":username", $POSTUSERNAME);
        $stmt->bindParam(":password", $hash);
        $stmt->bindParam(":firstName", $POSTFIRSTNAME);
        $stmt->bindParam(":lastName", $POSTLASTNAME);
        $stmt->bindParam(":zip", $POSTZIP);
        $stmt->bindParam(":city", $POSTCITY);
        $stmt->bindParam(":emailAddress", $POSTEMAILADRESS);
        $stmt->bindParam(":phoneNumber", $POSTPHONENUMBER);
        $stmt->execute();


        //Signs the new user in
        $_SESSION['username'] = $POSTUSERNAME;
        header('location: ./');
    }
}


function validateRegisterInput($POSTUSERNAME, $POSTPASSWORD, $POSTPASSWORD2, $POSTFIRSTNAME, $POSTLASTNAME, $POSTZIP, $POSTCITY, $POSTEMAILADRESS, $POSTPHONENUMBER){
    $userRegex = "/^[a-z0-9_-]*$/i";
    $passRegex = "/^(?=.*\d).{8,}$/";
    $nameRegex = "/^[a-z ,.'-]+$/i";
    $numberRegex = "/^[0-9]*$/";


    if (!preg_match($userRegex, $POSTUSERNAME)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die("Username: " . $POSTUSERNAME . " contains illegal characters");
    }
    if (!preg_match($passRegex, $POSTPASSWORD)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die("Password must contain 8 characters and at least 1 number");
    }
    if (!preg_match($passRegex, $POSTPASSWORD2)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die("Password must contain 8 characters and at least 1 number");
    }
    if (!preg_match($nameRegex, $POSTFIRSTNAME)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die($POSTFIRSTNAME . "is not a name");
    }
    if (!preg_match($nameRegex, $POSTLASTNAME)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die($POSTLASTNAME . "is not a name");
    }
    if (!preg_match($numberRegex, $POSTZIP)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die("Zip code: " . $POSTZIP . " contains letters");
    }
    if (!preg_match($nameRegex, $POSTCITY)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die($POSTCITY . " is not a city");
    }
    if (!filter_var($POSTEMAILADRESS, FILTER_VALIDATE_EMAIL)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die($POSTEMAILADRESS . "is not an email");
    }
    if (!preg_match($numberRegex, $POSTPHONENUMBER)) {
        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
        die($POSTPHONENUMBER . "is not a phone number");
    }

    //Password mismatch
    if ($POSTPASSWORD !== $POSTPASSWORD2) {
        die("Password mismatch");
    }
}


?>
</body>
</html>