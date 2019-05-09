<?php

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     
include dirname(__DIR__) . '/views/partials/navi.php';
include dirname(__DIR__) . '/views/partials/logout.php';

$userregname = "";
$password = "";
$confirmpw = "";
$usernameErr = $firstnameErr = $lastnameErr = $zipErr = $cityErr = $phoneErr = $zipErr = $conpwErr = "";
$regexcheck = 1;

    function test_input($entry) {
        $data = trim($entry);
        $data = stripcslashes($entry);
        $data = htmlspecialchars($entry);
        return $entry;
    }    

    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
        echo "<br>";
        $stylereg = "style='display:none;'";
        echo " <p class = 'success'> You're already registered. </p>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['submitregister'])) {
        $userregname = $_POST["userregname"];
        $password = $_POST["password"];
        $confirmpw = $_POST["confirmpw"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $zip = $_POST["zip"];
        $city = $_POST["city"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];

        if (!preg_match("/^[a-zA-Z ]*$/",$_POST["firstname"])) {
            $firstnameErr = "First name contains can only contain letters and spaces.";
            $regexcheck = 0;
        } 

        if (!preg_match("/^[a-zA-Z ]*$/",$_POST["lastname"])) {
            $lastnameErr = "Last name contains can only contain letters and spaces.";
            $regexcheck = 0;
        }

        if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["userregname"])) {
            $usernameErr = "User name contains illegal characters!";
            $regexcheck = 0;
        }

        if (!preg_match("/^[a-zA-Z ]*$/",$_POST["city"])) {
            $cityErr = "City names cannot contain numbers.";
            $regexcheck = 0;
        }

        if (!preg_match("/^[0-9]*$/",$_POST["phone"])) {
            $phoneErr = "Phone numbers can't contain letters.";
            $regexcheck = 0;
        }

        if ($password !== $confirmpw) {
            $conpwErr = "Passwords don't match!";
        }

        $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
        require $pathroot . '/mschm16/mvc/app/core/serverconn.php';

        if ($password === $confirmpw & !$regexcheck == 0) {
            $password = test_input($password);
            $confirmpw = test_input($confirmpw);
            $userregname = test_input($userregname);

            $sqlchecker = "SELECT userId FROM users WHERE userName = '$userregname'";

            $countname = 0;

            $result = mysqli_query($conn,$sqlchecker);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $active = $row['active'];
        
            $countname = mysqli_num_rows($result);

            if ($countname == 0) {
                $sqlreg = "INSERT INTO users (userName, userPass, userFirst, userLast, userZip, userCity, userPhone, userMail) VALUES ('$userregname', '$password', '$firstname', '$lastname', '$zip', '$city', '$phone', '$email')";
                
                if ($conn->query($sqlreg)) {
                    $conn->close();
                    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/mschm16/mvc/app/views/home/login.php" . $location);
                    exit;
                } else { 
                    echo "An error was encountered while parsing data to database! The error was: " . $conn->error . "while calling SQL method: " . $sqlreg;
                }
            } else {
                echo "Username already exists. Please log in!";
            } 
        } else if ($regexcheck == 0) {
            echo "Failed to register.";
        }
    }
?>