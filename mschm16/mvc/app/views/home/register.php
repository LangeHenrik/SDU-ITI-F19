<!DOCTYPE html>
<html lang="en">
<head>
<title>Registration</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="/mschm16/mvc/app/assets/css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <?php 
    $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     

        include $pathroot . '/mschm16/mvc/app/views/partials/navi.php';
        include $pathroot . '/mschm16/mvc/app/views/partials/logout.php';
        include $pathroot . '/mschm16/mvc/app/controllers/HomeController.php';

        $usernameErr = $phoneErr = $emailErr = $zipErr = $cityErr = $conpwErr = $lastnameErr = $firstnameErr = '';

    ?>
        <h1>Register</h1>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hc = new HomeController();
        $userregname = $_POST["userregname"];
        $password = $_POST["password"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $zip = $_POST["zip"];
        $city = $_POST["city"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $hc->register($userregname,$password,$firstname,$lastname,$zip,$city,$phone,$email);
    }

    if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
        echo "<br>";
        $stylereg = "style='display:none;'";
        echo " <p class = 'success'> You're already logged in! </p>";
    } else {
        $stylereg = "";
    }
    ?>   

<script type="text/javascript" src="/mschm16/mvc/app/controllers/JSHomeController.js"></script>

<div class = "register" <?php echo $stylereg;?>>
<form id = "registerform" onsubmit="return checkFields()" action="/mschm16/mvc/app/views/home/register.php" method="post">
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
    
</body>
</html>