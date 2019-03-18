<?php
  require "header.php";

 ?>

<main>
<?php
if (isset($_GET['error'])) {
  if ($_GET['error'] == 'emptyfields') {
    echo '<p>Input fields connot be empty</p>';
  }
}
if (isset($_SESSION['userid'])) {
  echo '<p class="login-status">You are logged in!</p>';
}
else{
echo'  <div class="login">
  <form  action="includes/login.inc.php" method="post">
  <label class="label" for="username">Username</label>
  <br>
  <input type="text" name="username" placeholder="Username">
  <br> <br>
  <label class="label" for="password">Password</label>
  <br>
  <input type="password" name="password" placeholder="Password">
  <br>
  <button type="submit" name="login_submit">Login</button>
  </form>
  <a href="signup.php">signup</a>';
}
 ?>

    </div>
  </body>
</main>
</html>
