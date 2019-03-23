<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body class="body">
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>


    
    <form action="reset-password.php">
    <p><input type="submit" href="reset-password.php" class="btn btn-warning" value="Reset Your Password"> </p>
    </form>
    
    <form action="logout.php">
    <p> <input type="submit" href="logout.php" class="btn btn-danger" value="Sign Out of Your Account"></p>
    </form>

    <form action="upload.php">
    <p> <input type="submit" href="upload.php" class="btn btn-primary" value="Look at pictures!"></p>
    </form>

 

    <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit" >Upload</button>
    <div>
    <br><br>
    <label class="header" for="header">Header &nbsp; </label>
    <input type="text" size="40" name="header" placeholder="Header here..">
    <br><br>
    </div>
    <div>
    <textarea name="text" rows="4" cols="40" placeholder="Describe this photo or file"></textarea>
    </div>
</form>

<p> <input id="showUsers" class="btn btn-success" value="Show users"></p>

<div id="usersDiv"></div>
    
</body>
</html>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="ajax.js"></script>
<link rel="stylesheet" href="style.css">