<?php
require "header.php";
?>

<main>
  <div class="space">
  </div>

  <div class="wrapper-main">
    <section class="section-default">
      <h1>Login</h1>
      <form class="form-signup" action="includes/login.inc.php" method="post">
        <div class="header-login">
          <?php
          if (isset($_SESSION['userId'])) {
            echo '<div class="div-form"><form action="includes/logout.inc.php" method="post">
            <button type="submit" name="Logout">Logout</button>
            </form></div>';
          }
          else {
            echo '<div class="div-form"><form action="includes/login.inc.php" method="post">
            <input class="inputfield" type="text" name="mailuid" placeholder="Username/E-mail...">
            <input class="inputfield" type="password" name="pwd" placeholder="Password">
            <button class="button" type="submit" name="Login">Login</button>
            </form>
            <a href="signup.php">Signup</a></div>';
          }
          ?>
        </div>
      </form>
    </section>
  </div>
  <div class="space">
  </div>
</main>

<?php
require "footer.php";
?>
