<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Registration </title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="styling/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="styling/favicon.png"/>
    </head>
<body>
        <h1> PhotoPost - Register </h1>

<p class = 'tagline'> - Your photo-sharing website </p>
        

<script>
        function checkFields() {
        var password = document.getElementById("password").value;
        if(password.length < 8) {
        alert("Password must be at least 8 characters");
        return false;
        } else {
        return true;
        }        
        }
        </script>



        <?php

        include 'navi.php';
        include 'logout.php';
    
    function test_input($entry) {
        $data = trim($entry);
        $data = stripcslashes($entry);
        $data = htmlspecialchars($entry);
        return $entry;
    }

    $username = "";
    $password = "";
    $confirmpw = "";
    $usernameErr = $firstnameErr = $lastnameErr = $zipErr = $cityErr = $phoneErr = $zipErr = $conpwErr = "";
    $regexcheck = 1;
    
   if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['submitregister'])) {
        $username = $_POST["username"];
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

    if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["username"])) {
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

    /*    if ($password != $confirmpw) { 
        
            echo("Entered passwords don't match!");
            
        } 
       
       else {
    */    
      require_once 'serverconn.php';

 /* if (empty($username)) {
        $nameErr = "User name is required";
      } else {
        $username = test_input($_POST["username"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
          $nameErr = "Only letters and white space allowed"; 
        }
      }
      
      if (empty($email)) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format"; 
        }
      }
        
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    } */


      if ($password === $confirmpw & !$regexcheck == 0) {

        $password = test_input($password);
        $confirmpw = test_input($confirmpw);
        $username = test_input($username);

   /*     checkillegals($username);
        checkillegals($password);
        checkillegals($confirmpw);
        checkillegals($firstname);
        checkillegals($lastname);
        checkillegals($zip);
        checkillegals($phone);
        checkillegals($email); */
//        if ($sqlcheck == 0) { 

//         $sqlreg = "INSERT INTO user (SELECT * FROM (SELECT '$username','$password', '$firstname', '$lastname', '$zip', '$phone', '$email') AS tmp WHERE NOT EXISTS (SELECT userName FROM user WHERE userName = '$username'))";

// TODO: Username check - if it exists, disallow registration with said username.

        $sqlchecker = "SELECT userID FROM user WHERE userName = '$username'";

        $result = mysqli_query($conn,$sqlchecker);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
      
        $countname = mysqli_num_rows($result);

        if ($countname == 0) {

        $sqlreg = "INSERT INTO user (userName, userPass, firstName, lastName, zip, city, phone, email) VALUES ('$username', '$password', '$firstname', '$lastname', '$zip', '$city', '$phone', '$email')";

//        $sqlreg = "INSERT INTO user (userName, userPass, firstName, lastName, zip, phone, email) VALUES ('$username', '$password', '$firstname', '$lastname', '$zip', '$phone', '$email')";
            
            if ($conn->query($sqlreg)) {
                $conn->close();
                header("Location: login.php");
                exit;
            }
            else { 
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

    
<form id = "registerform" onsubmit="return checkFields()" action="registeruser.php" method="post">
    <label for="firstname" >First name</label>
    <br>
    <input type="text" name="firstname" id="firstname"/> 
    <br>
    <span class="error"><?php echo $firstnameErr;?></span>
    <br>
    <label for="lastname" >Last name</label>
    <br>
    <input type="text" name="lastname" id="lastname"/> 
    <br>
    <span class="error"><?php echo $lastnameErr;?></span>
    <br>
    <label for="User name" >User name *</label>
    <br> 
    <input type="text" name="username" id="username" required/> 
    <br>
    <span class="error"><?php echo $usernameErr;?></span>
    <br>
    <label for="zip" >ZIP code</label>
    <br>
    <input type="number" name="zip" id="zip"/> 
    <br>
    <span class="error"><?php echo $zipErr;?></span>
    <br>
    <label for="text" >City</label>
    <br>
    <input type="text" name="city" id="city"/> 
    <br>
    <span class="error"><?php echo $cityErr;?></span>
    <br>
    <label for="email" >E-mail address</label>
    <br>
    <input type="email" name="email" id="email"/>
    <br>
    <span class="error"><?php echo $emailErr;?></span>
    <br>
    <label for="phone" >Phone number</label>
    <br>
    <input type="tel" name="phone" id="phone"/>
    <br>
    <span class="error"><?php echo $phoneErr;?></span>
    <br>
    <label for="password" >Password *</label>
    <br> 
    <input type="password" name="password" id="password" required/> 
    <br>
    <br>
    <label for="confirmpw">Confirm password *</label>
    <br>
    <input type="password" name="confirmpw" id="confirmpw" required/> 
    <br>
    <span class="error"><?php echo $conpwErr;?></span>
    <br>
    <input type="submit" name="submitregister" id="submitregister"/> 
</form>    

    <br>
    
</body>
</html>