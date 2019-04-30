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
  <input type="text" id="username" name="username" placeholder="Username" oninput="tjekusern()">
  <br> <br>
  <label class="label" for="password">Password</label>
  <br>
  <input type="password" name="password" placeholder="Password">
  <br> <br>
  <button type="submit" name="login_submit">Login</button>
  </form>
  <a href="signup.php">signup</a>';

}
 ?>

    </div>
    <script type="text/javascript">

      function tjekusern(){
        let username = document.getElementById('username').value;
        let regUN = /^[a-zA-Z0-9]*$/gm;
      if (!regUN.test(username)) {
        alert("only letters and numbers are allowed");
      }}

    </script>
  </body>
</main>
</html>
