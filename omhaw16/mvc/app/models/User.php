<?php

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);   
require_once $pathroot . '/omhaw16/mvc/app/core/Database.php';

class User extends Database {

public function __construct() {
	// $this->conn = new Database();
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
            echo "You're logged in, " . $username . "!";
            return true;
        } else { 
            echo "Error occurred, you're not logged in.";
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
                $dbc->connectToDB()->close();

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


    public function getAllUsers() { 

    $dbc = new Database();

    $dbc->connectToDB();

$sqlusers = "SELECT userID, userName FROM user";
  $resultusers = mysqli_query($dbc->connectToDB(),$sqlusers);
    
    $userfetchArray = array();

        if ($resultusers->num_rows > 0) {
            while ($row = $resultusers->fetch_assoc()) {

              //  array_push($userfetchArray, $row['userID'], $row['userName']);

                $oneUser['ID'] = $row['userID'];
                $oneUser['username'] = $row['userName'];
                $userObject[] = $oneUser;

                    //"username" . $row['userName']; 

//              echo "<p><b> User ID: </b>" . $row['userID'];
             /* echo "<br>";
              echo "<br>"; */
//              echo "<p> | ". $row['userName'] . " | </p>";


                }

              return $userObject;

              // echo "<br>";
              // echo "<br>";
              // echo "" . $row['userName'] . "";
} else {
  echo "<p> <b> No users </b> </p>";
}
	}

    public function showAllUsers() {

//        echo "Showing users.";

    $dbc = new Database();

    $dbc->connectToDB();

    $sqlusernames = "SELECT userName FROM user";
    $resultusernames = mysqli_query($dbc->connectToDB(),$sqlusernames);

    if ($resultusernames->num_rows > 0) {
            while ($row = $resultusernames->fetch_assoc()) {

                echo "<p> | ". $row['userName'] . " | </p>";
            }
        }
    }



//        $userArray = $this->getAllUsers();

//        print_r($userArray);

//     foreach($userArray as $id => $username) {

//                echo "$id => $username <br>";



//         foreach($userArray as $id => $username) {
//                print_r($username);
            //echo $userArray['userID'][0];
	
	/* public function deletePost($postID) {

	$dbc = new Database();
	
	$dbc->connectToDB();

		$imgname = "";

	$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     

	$imgpath = $pathroot . '/omhaw16/mvc/app/models/uploads/';

	$sqlfind = "SELECT postID, imgName FROM posts WHERE postID = '$postID'";

	$result = mysqli_query($dbc->connectToDB(),$sqlfind);
       
       if ($result->num_rows > 0) {

       	$row = $result->fetch_assoc();

        	$imgname = $row["imgName"];
            echo $imgname;
        	$fullpath = $imgpath . $imgname;
            echo $fullpath;
        	if (!unlink($fullpath)) {
        		echo "Couldn't delete file.";
        		echo $fullpath;
        	} else {
        		echo "File deleted.";
        	}

$sqldel = "DELETE FROM posts WHERE postID = '$postID'";

if ($dbc->connectToDB()->query($sqldel)) {

	$dbc->connectToDB()->close();
	               header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/omhaw16/mvc/app/views/home/myposts.php" . $location);
	exit;

} else { 
        		echo "Count not larger than 0";
        	}
        }

	} */

}