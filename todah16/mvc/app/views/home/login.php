<!--DOCTYPE_HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Dankify</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
  <!--Linked to CSS file -->    
    <link rel="stylesheet" type="text/css" href="../CSS/loggedIn.css"/>
    
</head>
    
<?php
    include '../app/views/partials/header.php';
    
    ?>
    
<body>
    <!-- Creates a container for the login -->
    <form name="login_form" action="/todah16/mvc/public/service/login" method="post">    
    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" id="login_uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="login_psw" required>
        
        <button type="submit" name="login">Login </button>
           
    </div>
       
        
        
    </form>
    
     
  <!--      
      
    <div class="cancelContainer">    
        <h1></h1>
        <a href ="other">Cancel</a>
      
    </div>
    

    <div class="registerContainer">
        <h1></h1>
        <a href ="register">Signup</a> 
    </div>
        
   -->  
    
    <script>
        
    
    
    </script>
    
    
</body>