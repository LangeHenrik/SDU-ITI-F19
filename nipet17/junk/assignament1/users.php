<!DOCTYPE html>
<?php
  session_start();

  if (!isset($_SESSION["username"])) {
    header("location:login.php");
  }
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Users</title>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="logo">
          <img src="img/logo.png" height="50" alt="" title="">
        </div>

        <nav>
          <li><a href="pictures.php">Pictures</a></li>
          <li><a href="users.php">Users</a></li>
          <?php
            if (isset($_SESSION["username"])) {
              echo '<li><a href="logout.php">Logout</a>';
            }
          ?>
        </nav>
        </div>
      </div>
    </header>

    <main>
      <br>
      <h1>User list</h1>
      <?php
        // Connects to database
        require_once("db_config.php");
        $object = new db_config_class;
        $db = $object->connect();

        $stmt = $db->query("SELECT * FROM login;");
        $stmt->execute();


        // iterating over a statement
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div id='users'>";
              echo "<h3>".$row['login_username']."</h3>";
              echo "";
              echo "<p>Name: &nbsp;&nbsp;".$row['login_name']."</p>";
              echo "<p>Email: &nbsp;&nbsp; ".$row['login_email']."</p>";
              echo "<p>Phone: &nbsp;".$row['login_phone']."</p>";
              echo "<p>City: &nbsp; &nbsp; &nbsp;".$row['login_zip'].", ".$row['login_city']."</p>";
            echo "</div>";

            //echo "<";
          }
      ?>

    </main>
  </body>
</html>
