<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/mschm16/mvc/app/assets/css/style.css">
<title>Login</title>
<meta charset="utf-8"/>
</head>
<body>
    <?php 
    $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     
    include $pathroot . '/mschm16/mvc/app/views/partials/navi.php';
    include $pathroot . '/mschm16/mvc/app/views/partials/logout.php'; 
    include $pathroot . '/mschm16/mvc/app/controllers/HomeController.php';

    $loginuser = $loginpass = $usernameErr = '';
    ?>
    <h1> Login </h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hc = new HomeController();
        $loginuser = $_POST["user"];
        $loginpass = $_POST["pw"];
        $hc->login($loginuser,$loginpass);
        header("Location: /mschm16/mvc/public/index.php");
        exit;
    }

    if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
        echo "<br>";
        $stylelog = "style='display:none;'";
        echo " <p class = 'success'>Already logged in</p>";
        header("Location: /mschm16/mvc/public/index.php");
        exit;
    } else {
        $stylelog = "";
    }
    ?>

    <div class = "login" <?php echo $stylelog;?>>
    <form name ="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="name" style="color: white;">Name</label>
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
    <input type="submit" name="submit" id="submit" placeholder='Login'/>
    <br>
    <p>Register as new user - <a href="/mschm16/mvc/app/views/home/register.php"> Click here!</a> </p>
</div>
</form>
    
</body>
</html>