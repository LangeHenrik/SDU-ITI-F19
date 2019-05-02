<?php

 ?>

 <main>
   <h1>signup</h1>
   <?php
  /* if( isset($_POST['signup_submit'])){


     $user['firstname'] = $_POST['firstname'];
     $user['lastname'] = $_POST['lastname'];
     $user['email'] = $_POST['email'];
     $user['zip'] = $_POST['zip'];
     $user['city'] = $_POST['city'];
     $user['phonenumber'] = $_POST['phonenumber'];
     $user['username'] = $_POST['username'];
     $user['email'] = $_POST['email'];
     $user['password'] = $_POST['password'];
     $user['rep_password'] = $_POST['rep_password'];
     $_POST['json'] = json_encode($user);

     echo $_POST['json'];
     header('Location:../../../mvc/public/Api/createUser');
   }*/
  

   if (isset($_GET['error'])) {
       if ($_GET['error'] =="emptyfields") {
           echo '<p>fields cannot be empty </p>';
       }
   } elseif (isset($_GET['signup'])) {
       if ($_GET['signup']== 'success') {
           echo '<p>signup successful!!</p>';
       }
   }
    ?>
<body>


   <form  action="../../../mvc/public/home/createUser" method="POST">
     <input type="text" name="firstname" id="firstname" placeholder="Firstname" oninput="tjekfname()" required>
     <br> <br>
     <input type="text" name="lastname" id="lastname" placeholder="Lastname" oninput="tjeklname()" required>
     <br><br>
     <input type="text" name="zip" id="zip" placeholder="Zip Code" oninput="tjekzip()" required>
     <br><br>
     <input type="text" name="city" id="city" placeholder="City" oninput="tjekcity()" required>
     <br> <br>
     <input type="text" name="phonenumber" id="phonenumber" placeholder="Phonenumber" oninput="tjekpnumber()" required>
     <br><br>
     <input type="text" name="email" id="email" placeholder="Email" oninput="tjekemail()" required>
     <br><br>
     <input type="text" name="username" id="username" placeholder="Username" oninput="tjekusern()" required>
     <br> <br>
     <input type="password" name="password" placeholder="Password" required>
     <br> <br>
     <input type="password" name="rep_password" placeholder="repeat password" required>
     <br><br>
     <button type="submit" name="signup_submit">Signup</button>
   </form>
   <script type="text/javascript">

     function tjekusern(){
       let username = document.getElementById('username').value;
       let regUN = /^[a-zA-Z0-9]*$/gm;
     if (!regUN.test(username)) {
       alert("only letters and numbers are allowed");
     }}
     function tjekfname(){
       let username = document.getElementById('firstname').value;
       let regUN = /^[a-zA-ZÆØÅæøå]*$/gm;
     if (!regUN.test(username)) {
       alert("only letters are allowed");
     }}
     function tjeklname(){
       let username = document.getElementById('lastname').value;
       let regUN = /^[a-zA-ZÆØÅæøå]*$/gm;
     if (!regUN.test(username)) {
       alert("only letters are allowed");
     }}
     function tjekzip(){
       let username = document.getElementById('zip').value;
       let regUN = /^[0-9]*$/gm;
     if (!regUN.test(username)) {
       alert("only numbers are allowed");
     }}
     function tjekcity(){
       let username = document.getElementById('city').value;
       let regUN = /^[a-zA-ZÆØÅæøå]*$/gm;
     if (!regUN.test(username)) {
       alert("only letters are allowed");
     }}
     function tjekpnumber(){
       let username = document.getElementById('phonenumber').value;
       let regUN = /^[0-9]*$/gm;
     if (!regUN.test(username)) {
       alert("only numbers are allowed");
     }}


   </script>
  </body>
 </main>

 <?php

  ?>
