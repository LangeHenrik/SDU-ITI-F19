<!DOCTYPE html>
<html lang="en">
    <head>
        <title> The Website </title>
        <meta charset="utf-8"/>
    </head>
<body>
        <h1> Register on the Website! ™ </h1>
        
        <?php
    
    $username = "";
    $password = "";
    $confirmpw = "";
    $usernameErr = "";
    $usernamecheck = 1;
    
   if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['submitregister'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmpw = $_POST["confirmpw"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $zip = $_POST["zip"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
    
    if (!preg_match("/^[a-zA-Z]*$/",$_POST["username"])) {
        $usernameErr = "User name contains illegal characters!";
        $usernamecheck = 0;
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


      if ($password === $confirmpw & !$logincheck == 0) {

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

        $sqlreg = "INSERT INTO user (userName, userPass, firstName, lastName, zip, phone, email) VALUES ('$username', '$password', '$firstname', '$lastname', '$zip', '$phone', '$email')";

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
        } else if (!$password === $confirmpw) {
            echo "Passwords don't match!";
        } else if ($logincheck = 0) {
            echo "Failed to register.";
        }
        }
    
    ?>

    
<form id = "registerform" action="registeruser.php" method="post">
    <label for="firstname" >First name</label>
    <br>
    <input type="text" name="firstname" id="firstname"/> 
    <br>
    <label for="lastname" >Last name</label>
    <br>
    <input type="text" name="lastname" id="lastname"/> 
    <br>
    <label for="User name" style="color: red;">User name</label>
    <br> 
    <input type="text" name="username" id="username" required/> 
    <br>
    <span class="error"><?php echo $usernameErr;?></span>
    <br>
    <label for="zip" >ZIP code</label>
    <br>
    <input type="number" name="zip" id="zip"/> 
    <br>
    <label for="email" >E-mail address</label>
    <br>
    <input type="email" name="email" id="email"/> 
    <br>
    <label for="phone" >Phone number</label>
    <br>
    <input type="tel" name="phone" id="phone"/> 
    <br>
    <label for="password" style="color: red;">Password</label>
    <br> 
    <input type="password" name="password" id="password" required/> 
    <br>
    <label for="confirmpw" style="color: red;" >Confirm password</label>
    <br>
    <input type="password" name="confirmpw" id="confirmpw" required/> 
    <br>
    <input type="submit" name="submitregister" id="submitregister"/> 
</form>    

    <br>
    <?php include 'logout.php';?>
    
</body>
</html>