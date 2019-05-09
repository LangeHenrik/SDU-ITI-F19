<?php

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);   
require_once $pathroot . '/mschm16/mvc/app/core/Database.php';

class User extends Database {

public function __construct() {
	$loggedin = 0;
	$loginuser = "";
	$loginpass = "";
	$usernameErr = "";
}

public function loginAPI($username,$password) {
    $dbc = new Database();
    $dbc->connectToDB();
    $sql = "SELECT userID FROM user WHERE userName = '$username' AND userPass = '$password'";
    $result = mysqli_query($dbc->connectToDB(),$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    $count = mysqli_num_rows($result);
    
    if ($count == 1) {
        echo "Welcome, " . $username . "!";
        return true;
    } else { 
        echo "Not logged in.";
        return false;
    }
}

public function login($username,$password) {
	$dbc = new Database();
	$dbc->connectToDB();

    if(session_status() == PHP_SESSION_NONE) {
        session_start();
        echo "Session started.";
    }

    if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

        $stylelog = "style='display:none;'";
        return false;
        
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
        if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["user"])) {
            $regexcheck = 0;
            return false;
        }  
    
    	$dbc->connectToDB();
    	echo "Connected to DB.";
        $sql = "SELECT userId FROM users WHERE userName = '$username' AND userPass = '$password'";
        $result = mysqli_query($dbc->connectToDB(),$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
        $count = mysqli_num_rows($result);
        
        if ($count > 0) {

            echo "Welcome!";
        
            if(session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            $_SESSION['userID'] = $row["userId"];
            $_SESSION['userName'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['login'] = 1;
            $dbc->connectToDB()->close();

            echo "Login successful!";
            return true;
            header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/mschm16/mvc/public/index.php" . $location);
            
          } else if ($count == 0) {
            echo " - Problem!! Nothing found in DB. -";
          	return false;
            
        } else { 
            echo "An error was encountered while passing data to database! The error was: " . $conn->error . "while calling SQL method: " . $sql;
            return false;
        }

       if (!isset($_SESSION['login'])) { 
            echo " You're a guest.";
            return false;
        } else { 
            echo " Hello user.";
            return true;
        } 
    } 
    return false;
}

public function test_input($entry) {
    $data = trim($entry);
    $data = stripcslashes($entry);
    $data = htmlspecialchars($entry);
    return $entry;
}    

public function register($username,$password,$firstname,$lastname,$zip,$city,$phone,$email) {

    $dbc = new Database();
    $dbc->connectToDB();
    $userregname = "";
    $password = "";
    $confirmpw = "";
    $usernameErr = $firstnameErr = $lastnameErr = $zipErr = $cityErr = $phoneErr = $zipErr = $conpwErr = "";
    $regexcheck = 1;    

    if(session_status() == PHP_SESSION_NONE) {
        session_start();
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

        if ($password === $confirmpw & !$regexcheck == 0) {

            $password = $this->test_input($password);
            $confirmpw = $this->test_input($confirmpw);
            $userregname = $this->test_input($userregname);

            $sqlchecker = "SELECT userId FROM users WHERE userName = '$userregname'";

            $countname = 0;

            $result = mysqli_query($dbc->connectToDB(),$sqlchecker);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $active = $row['active'];
        
            $countname = mysqli_num_rows($result);

            if ($countname == 0) {

            $sqlreg = "INSERT INTO users (userName, userPass, userFirst, userLast, userZip, userCity, userPhone, userMail) VALUES ('$userregname', '$password', '$firstname', '$lastname', '$zip', '$city', '$phone', '$email')";
                
                if ($dbc->connectToDB()->query($sqlreg)) {
                    $dbc->connectToDB()->close();
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
}

public function getAllUsers() { 

    $dbc = new Database();
    $dbc->connectToDB();

    $sqlusers = "SELECT userId, userName FROM users";
    $resultusers = mysqli_query($dbc->connectToDB(),$sqlusers);
    $userfetchArray = array();

    if ($resultusers->num_rows > 0) {
        while ($row = $resultusers->fetch_assoc()) {
            $oneUser['ID'] = $row['userId'];
            $oneUser['username'] = $row['userName'];
            $userObject[] = $oneUser;

        }
        return $userObject;
    } else {
        echo "<p> <b> No users </b> </p>";
    }
}

public function showAllUsers() {

    $dbc = new Database();
    $dbc->connectToDB();
    $sqlusernames = "SELECT userName FROM users";
    $resultusernames = mysqli_query($dbc->connectToDB(),$sqlusernames);

    if ($resultusernames->num_rows > 0) {
            while ($row = $resultusernames->fetch_assoc()) {
                echo "<p>". $row['userName'] . "</p>";
            }
    }
}
}