<?php
class User extends Database {

    $loggedin = 0;
    $loginuser = "";
    $loginpass = "";
    $usernameErr = "";

    if(session_status() == PHP_SESSION_NONE) {
                session_start();
        }

    if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
    echo "<br>";

    $stylelog = "style='display:none;'";
    
    echo " <p class = 'success'> You're already logged in. </p>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $loginuser = $_POST["user"];
        $loginpass = $_POST["pw"];

        if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["user"])) {
        $usernameErr = "User name contains illegal characters!";
        $regexcheck = 0;
    }  
       
              $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]); 
       require $pathroot . '/omhaw16/mvc/app/core/serverconn.php';
        
        $sql = "SELECT userID FROM user WHERE userName = '$loginuser' AND userPass = '$loginpass'";

        $result = mysqli_query($conn,$sql);
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
                $_SESSION['userName'] = $loginuser;
                $_SESSION['password'] = $loginpass;
                $_SESSION['login'] = 1;
                $conn->close();
            
          }  else if ($count == 0) {
                
                echo "<p class = 'status'> Log in failed. Username & password do not match. </p>";
            
            } else { 
            echo "An error was encountered while passing data to database! The error was: " . $conn->error . "while calling SQL method: " . $sql;
    }

       if (!isset($_SESSION['login'])) { 

            echo " You're a guest.";

        } else { 

            echo " Hello user.";

            } 
        }
    

}