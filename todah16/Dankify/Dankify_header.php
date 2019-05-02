<?php
    session_start();
?>

<!--DOCTYPE_HTML-->
<html>
<head>
    <!-- Title and author-->
    <title>Dankify</title>
    <meta charset="utf-8">
    <meta name="author" content="Tobias Dahl">
    
<!--Linked to CSS file-->    
<link rel="stylesheet" type="text/css" href="CSS\Dankify_NAVIGATION.css"/>
<style>
    
    
</style> 
    
</head>    
    
<body>    
<div class="container-navigation">
    
<section class="top">
<h1>Dankify</h1>
<p> The future is in the past</p>
</section>
    
    
<section class="navigation" >
   <ul>
    <li><a class="active" href="index.php">Home</a></li>
       <?php
    if(isset($_SESSION['user_name'])){
        echo '<style>
        
        
   #logout {
  display: block;
  color: white;
  border: none;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  background-color:#383838;
}

 #logout:hover{
    background-color:lightgreen;
}


</style>
';
        echo   '<li><a href="Dankify_my_images.php">My images</a></li>';
        echo   '<form name="logout_form" action="includes/logout.inc.php" method="post">  
        <button id="logout" type="submit" name="logout">Logout</button>
        
        </form>';
    } else {
        echo '<li><a href="Dankify_login.php">Login</a></li>';
        echo '<li><a href="Dankify_register.php">Register</a></li>';
    }        
    ?>
    </ul> 
     
</section>   
</div> <!-- end of div related to the navigation bar --> 
    
</body>
</html>
