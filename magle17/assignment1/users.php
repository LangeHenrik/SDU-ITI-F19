
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!(isset($_SESSION['loggedInUser'])) || ($_SESSION['loggedin'] !== true)) {
    echo 'You are not logged in!';
    return;
}
if(isset($_POST["logout"])) {
    header('Location: index.php');
    session_destroy();
}
if(isset($_POST["goto-userImages"])){
    header('Location: userImages.php');
}
if(isset($_POST["goto-images"])){
    header('Location: images.php');
}

require_once 'db_config.php';

try{
    $conn = new PDO("mysql:host=$servername;dbname=$db_name",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $preparedGetUsers=$conn->prepare('SELECT * FROM users');

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

/*if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']){

  $tabledata='';

  $preparedGetUsers->execute();
  $preparedGetUsers->setFetchMode(PDO::FETCH_ASSOC);
  $result=$preparedGetUsers->fetchAll();
  foreach($result as $row){
      $tabledata."<tr>";
      $tabledata."<td>".$row['id']."</td>";
      $tabledata."<td>".$row['username']."</td>";
      $tabledata."<td>".$row['firstname']."</td>";
      $tabledata."<td>".$row['lastname']."</td>";
      $tabledata."<td>".$row['zip']."</td>";
      $tabledata."<td>".$row['city']."</td>";
      $tabledata."<td>".$row['email']."</td>";
      $tabledata."<td>".$row['phone']."</td>";
      $tabledata."<td>".$row['password']."</td>";
      $tabledata."</tr>";
  }
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
      <h1>Dét Sgu Da De BLÆREDE BRUGERE</h1>
      <h2>Stedet hvor du kan se alles data</h2>
      <form action="userImages.php" method="post" class="nav-button">
        <input type="submit" name="logout" value="Log ud">
      </form>
      <form action="users.php" method="post" class="nav-button">
        <input type="submit" name="goto-images" value="Alle Blærede Billeder">
      </form>
      <form action="users.php" method="post" class="nav-button">
        <input type="submit" name="goto-userImages" value="Dine Blærede Billeder">
      </form>
      <div class="table-container">
        <table id="user-table">
            <tr id="user-table-header">
                <th>ID</th>
                <th>Username</th>
                <th>Fornavn</th>
                <th>Efternavn</th>
                <th>Postnummer</th>
                <th>Bynavn</th>
                <th>email</th>
                <th>Telefonnummer</th>
                <th>Top-Hemmelige Password</th>
            </tr>
            <?php
                $preparedGetUsers->execute();
                $preparedGetUsers->setFetchMode(PDO::FETCH_ASSOC);
                $result=$preparedGetUsers->fetchAll();
                foreach($result as $row){
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['firstname']."</td>";
                    echo "<td>".$row['lastname']."</td>";
                    echo "<td>".$row['zip']."</td>";
                    echo "<td>".$row['city']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['phone']."</td>";
                    echo "<td>".$row['password']."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
      </div>
      <footer class="footer" id="footer">
      <p>Copyright: none</p>
      <p>Terms of use: none</p>
    </footer>
    </div>
  </body>
</html>
