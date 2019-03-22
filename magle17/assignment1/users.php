
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/*if (!(isset($_SESSION['loggedInUser'])) || ($_SESSION['loggedin'] !== true)) {
    echo 'You are not logged in!';
    return;
}
if(isset($_POST["logout"])) {
    header('Location: index.php');
    session_destroy();
}*/
if(isset($_POST["goto-images"])){
    header('Location: images.php');
}


require_once 'db_config.php';

/*try{
    $conn = new PDO("mysql:host=$servername;dbname=$db_name",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $preparedGetImages=$conn->prepare('SELECT * FROM users;');

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}*/

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel ="stylesheet" type="text/css" href="stylesheet.css">
    <script src="script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlæredeBilleder</title>
  </head>
  <body>
    <div class="base">
      <h1>Dét Sgu Da BLÆREDE BILLEDER</h1>
      <h2>Stedet hvor intet er privat og alt er lovligt</h2>
      <form action="users.php" method="post" class="nav-button">
          <input type="submit" name="logout" value="Log ud">
      </form>
      <form action="users.php" method="post" class="nav-button">
          <input type="submit" name="goto-images" value="Billeder">
      </form>
      <footer class="footer" id="footer">
      <p>Copyright: none</p>
      <p>Terms of use: none</p>
    </footer>
    </div>
  </body>
</html>
