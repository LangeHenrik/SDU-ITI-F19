<?php

include dirname(__DIR__) . '/views/partials/navi.php';
include dirname(__DIR__) . '/views/partials/logout.php';

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);   
 require $pathroot . '/omhaw16/mvc/app/core/Database.php';

class User extends Database {

public function __construct() {
	// $this->conn = new Database();
	$loggedin = 0;
	$loginuser = "";
	$loginpass = "";
	$usernameErr = "";
}

public function login($username,$password) {
	$dbc = new Database();

	$dbc->connectToDB();

    if(session_status() == PHP_SESSION_NONE) {
                session_start();
                echo "Session started.";
        }

    if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
 //   echo "<br>";

    $stylelog = "style='display:none;'";
    
/*	echo "<p class = 'success'> You're already logged in! </p>" . $_SESSION['login'];
	echo $_SESSION['userName'];
	echo $_SESSION['userID'];
*/
//    echo " <p class = 'success'> You're already logged in. </p>";

    	return false;
    } else {
    	// echo "Session status for Login " . $_SESSION['login'];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     //   $loginuser = $_POST["user"];
     //   $loginpass = $_POST["pw"];

        if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["user"])) {
      //  $usernameErr = "User name contains illegal characters!";
        $regexcheck = 0;

        return false;
    }  
      //  $loginuser = $_POST["user"];
      //  $loginpass = $_POST["pw"];

    	$dbc->connectToDB();

    	echo "Connected to DB.";

        $sql = "SELECT userID FROM user WHERE userName = '$username' AND userPass = '$password'";

        $result = mysqli_query($dbc->connectToDB(),$sql);
 //       echo "result set." . $dbc . "yea buddy";
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
      
        $count = mysqli_num_rows($result);
        
        if ($count == 1) {

                echo "Welcome!";
                
                header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/omhaw16/mvc/public/index.php" . $location);
                if(session_status() == PHP_SESSION_NONE) {
                session_start();
                }
                $_SESSION['userID'] = $row["userID"];
                $_SESSION['userName'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['login'] = 1;
                $conn->close();

                echo "Login successful!";
                return true;
            
          }  else if ($count == 0) {
                
          //      echo "<p class = 'status'> Log in failed. Username & password do not match. </p>";
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
        } return false;
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

/*       $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
       require $pathroot . '/omhaw16/mvc/app/core/serverconn.php';
*/
      if ($password === $confirmpw & !$regexcheck == 0) {

        $password = $this->test_input($password);
        $confirmpw = $this->test_input($confirmpw);
        $userregname = $this->test_input($userregname);

        $sqlchecker = "SELECT userID FROM user WHERE userName = '$userregname'";

        $countname = 0;

        $result = mysqli_query($dbc->connectToDB(),$sqlchecker);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
      
        $countname = mysqli_num_rows($result);

        if ($countname == 0) {

        $sqlreg = "INSERT INTO user (userName, userPass, firstName, lastName, zip, city, phone, email) VALUES ('$userregname', '$password', '$firstname', '$lastname', '$zip', '$city', '$phone', '$email')";
            
            if ($dbc->connectToDB()->query($sqlreg)) {
                $dbc->connectToDB()->close();
                header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/omhaw16/mvc/app/views/home/login.php" . $location);
                exit;
            }
            else { 
            echo "An error was encountered while parsing data to database! The error was: " . $conn->error . "while calling SQL method: " . $sqlreg;
    }
        } else {

            echo "Username already exists. Please log in!";
            // DEBUGGING ECHO's:
            // echo $userregname;
            // echo $result;
            // echo $countname;
            // echo $row;

        } 
        } else if ($regexcheck == 0) {
            echo "Failed to register.";
        }
        }

	}

	public function uploadPic($postedby,$imgname,$imgtitle,$imgdesc) {
		$imgtitle = "";
		$imgdesc = "";
		$imgname = "";
		$postedby = "";

if(session_status() == PHP_SESSION_NONE) {
session_start();
}

$dbc = new Database();

	$dbc->connectToDB();

$postedby = $_SESSION["userID"];

if ($_SESSION["login"] == 1) {

if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['submitimg'])) {

$imgtitle = $_POST["imgtitle"];
$imgdesc = $_POST["imgdesc"];
$imgname = basename($_FILES["fileToUpload"]["name"]);

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);
$target_dir = $pathroot . "/omhaw16/mvc/app/models/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));




// Check if image file is a actual image or fake image
if(isset($_POST["submitimg"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "<p class='guide'>File is an image - " . $check["mime"] . ". </p>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "<p class='status'> Sorry, file already exists. </p>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "<p class='status'> Sorry, your file is too large. </p>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<p class = 'status'> Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<p class = 'status'> Sorry, your file was not uploaded. UploadOK = 0 by mistake. </p>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<p class = 'success'> The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded. <p>";

		$dbc = new Database();

		$dbc->connectToDB();

/*              $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
       require $pathroot . '/omhaw16/mvc/app/core/serverconn.php';
       // echo $sqlinsimg; */
        
        $sqlinsimg="INSERT INTO posts (postedby, imgName, imgTitle, imgDesc, imgDate) VALUES('$postedby','$imgname', '$imgtitle', '$imgdesc', NOW())";
        // echo $sqlinsimg;


 //       echo $sqlinsimg;

        if ($dbc->connectToDB()->query($sqlinsimg)) {
        //    echo " Upload to database done! ";
            $dbc->connectToDB()->close();
            } else {
                echo "DB-upload not done. " . $dbc->connectToDB()->error();
            }

     //       echo "database stuff done.";

    } else {
        // echo $_FILES["fileToUpload"];
        echo "<p class='guide'> Target file: " . $target_file;
        echo $_FILES["tmp_name"];
        echo "Sorry, there was an error uploading your file.";
    }
}
} 
} else if ($_SESSION['login'] == 0) {
    echo "<p class='guide'> Please log in, before you upload. </p>";
}
	}
}