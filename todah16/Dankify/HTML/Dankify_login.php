<!--DOCTYPE_HTML-->
<html>
<head>
    <!-- Title and author-->
    <title>Dankify</title>
    <meta charset="utf-8">
    <meta name="author" content="Tobias Dahl">
    
<!--Linked to CSS file-->    
<link rel="stylesheet" type="text/css" href="/CSS/Dankify_login.css"/>

<!-- CDN connection to JQUERY -->    
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous">
</script> 

    
<?php
    require "dankify_header.php"

    
?>


 
    
</head>    
    
<body>

    <main>
    <!-- Creates an container for the future user image -->
    <div class="imgcontainer">
    
    </div>

    <!-- Creates a container for the login -->
    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <button type="submit">Login</button>    
    </div>
    
     <!-- Creates a link for the cancel button -->
    <div class="cancelContainer">    
        <h1></h1>
        <a href ="Dankify_header.php">Cancel</a>
      
    </div>
    
     <!-- Creates a link for the register button -->
    <div class="registerContainer">
        <h1></h1>
        <a href ="Dankify_register.php">Signup</a> 
    </div>
    </main>    

    
    <script>
    
    
    
    </script>
    
    
</body>