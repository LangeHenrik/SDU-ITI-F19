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

      <?php $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     

        include $pathroot . '/omhaw16/mvc/app/views/partials/navi.php';
        include $pathroot . '/omhaw16/mvc/app/views/partials/logout.php';
        include $pathroot . '/omhaw16/mvc/app/controllers/HomeController.php';?>
  
    <? // -- to remove form if logged in -- php include $pathroot . '/omhaw16/mvc/app/controllers/User.php';?>

    <?php $hc = new HomeController();
    $userregname = $_POST["userregname"];
    $password = $_POST["password"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $zip = $_POST["zip"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $hc->register($userregname,$password,$firstname,$lastname,$zip,$city,$phone,$email);

    if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
    echo "<br>";
    $stylereg = "style='display:none;'";
    echo " <p class = 'success'> You're already registered. </p>";
    }

    ?>   

<script type="text/javascript" src="/omhaw16/mvc/app/controllers/JSHomeController.js"></script>

<div class = "register" <?php echo $stylereg;?>>
<form id = "registerform" onsubmit="return checkFields()" action="/omhaw16/mvc/app/views/home/register.php" method="post">
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