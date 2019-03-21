<!DOCTYPE html>
<html lang="en">
    <head>
        <title> The Website </title>
        <meta charset="utf-8"/>
    </head>
<body>
    
    <h1> Welcome to The Website! ™ </h1>
    
        <?php 

    $loggedin = 0;
    $loginuser = "";
    $loginpass = "";
    $usernameErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $loginuser = $_POST["user"];
        $loginpass = $_POST["pw"];

        if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["user"])) {
        $usernameErr = "User name contains illegal characters!";
        $regexcheck = 0;
    }
       
       require 'serverconn.php';
        
        $sql = "SELECT userID FROM user WHERE userName = '$loginuser' AND userPass = '$loginpass'";

        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
      
        $count = mysqli_num_rows($result);
        
        if ($count == 1) {

                echo "Welcome!";
                
                header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/ITICloned/omhaw16" . $location);
                if(session_status() == PHP_SESSION_NONE) {
                session_start();
                }
                $_SESSION['userID'] = $row["userID"];
                $_SESSION['userName'] = $loginuser;
                $_SESSION['password'] = $loginpass;
                $_SESSION['login'] = 1;
                $conn->close();
            
          }  else if ($count == 0) {
                
                echo "Log in failed. Username & password do not match.";
            
            } else { 
            echo "An error was encountered while passing data to database! The error was: " . $conn->error . "while calling SQL method: " . $sql;
    }

       if (!isset($_SESSION['login'])) { 

            echo " You're a guest.";

        } else { 

            echo " Hello user.";

            } 
        }
    
    ?>

    <form action="#" method="post">
    <label for="name" style="color: blue;">Name</label>
    <br> 
    <input type="text" name="user" id="user"/> 
    <br>
    <span class="error"><?php echo $usernameErr;?></span>
    <br>
    <label for="password">Password</label>
    <br> 
    <input type="password" name="pw" id="pw"/> 
    <br>
    <br>
    <input type="submit" name="submit" id="submit"/> 
</form>

    
</body>
</html>