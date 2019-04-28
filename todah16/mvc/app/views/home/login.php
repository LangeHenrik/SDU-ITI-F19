<!--DOCTYPE_HTML-->
<html>
<head>
    <!-- Title and author-->
    <title>Dankify</title>
    <meta charset="utf-8">
    <meta name="author" content="Tobias Dahl">
    
<!--Linked to CSS file-->    
<link rel="stylesheet" type="text/css" href="CSS/Dankify_login.css"/>

    
<?php
    include '../app/views/partials/header.php';

    
?>


 
    
</head>    
    
<body>
    <!-- Creates a container for the login -->
    <form name="login_form" action="services/loginService" method="post">    
    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" id="login_uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="login_psw" required>
        
        <button type="submit" name="login">Login </button>
           
    </div>
       
        
        
    </form>
    
     
        
        <!-- Creates a link for the cancel button -->
    <div class="cancelContainer">    
        <h1></h1>
        <a href ="other">Cancel</a>
      
    </div>
    
     <!-- Creates a link for the register button -->
    <div class="registerContainer">
        <h1></h1>
        <a href ="register">Signup</a> 
    </div>
        
     
    
    <script>
        
    
    
    </script>
    
    
</body>