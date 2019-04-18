<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Registration </title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="/omhaw16/mvc/app/views/styling/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="/omhaw16/mvc/app/views/styling/favicon.png"/>
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

    $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     
    include $pathroot . '/omhaw16/mvc/app/views/partials/navi.php';
    include $pathroot . '/omhaw16/mvc/app/views/partials/logout.php';

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
       require $pathroot . '/omhaw16/mvc/app/core/serverconn.php';

      if ($password === $confirmpw & !$regexcheck == 0) {

        $password = test_input($password);
        $confirmpw = test_input($confirmpw);
        $userregname = test_input($userregname);

        $sqlchecker = "SELECT userID FROM user WHERE userName = '$userregname'";

        $countname = 0;

        $result = mysqli_query($conn,$sqlchecker);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
      
        $countname = mysqli_num_rows($result);

        if ($countname == 0) {

        $sqlreg = "INSERT INTO user (userName, userPass, firstName, lastName, zip, city, phone, email) VALUES ('$userregname', '$password', '$firstname', '$lastname', '$zip', '$city', '$phone', '$email')";
            
            if ($conn->query($sqlreg)) {
                $conn->close();
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
        
    ?>

    
<div class = "register" <?php echo $stylereg;?>>
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
    <input type="text" name="userregname" id="userregname" required/> 
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