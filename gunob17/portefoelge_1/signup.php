<?php
  require "header.php";
 ?>

 <main>
   <h1>signup</h1>
   <?php
   if (isset($_GET['error'])) {
     if ($_GET['error'] =="emptyfields") {
       echo '<p>fields cannot be empty </p>';
     }
   }
   elseif (isset($_GET['signup'])) {
       if ($_GET['signup']== 'success') {
     echo '<p>signup successful!!</p>';
   }
   }
    ?>

   <form  action="includes/signup.inc.php" method="post">
     <input type="text" name="email" placeholder="email" required>
     <input type="text" name="username" placeholder="username" required>
     <input type="password" name="password" placeholder="Password" required>
     <input type="password" name="rep_password" placeholder="repeat password" required>
     <button type="submit" name="signup_submit">Signup</button>
   </form>
 </main>

 <?php

  ?>
