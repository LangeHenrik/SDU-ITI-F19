
<?php
  session_start();

  if (!(isset($_SESSION['Login'])) || $_SESSION['Login'] !== true) {
    echo 'You are not logged in.';
    return;
  }

  $q = $_GET['q'];
  try {
    require_once 'db_config.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if (!$conn) {
        die('Could not connect: ' . mysqli_error($con));
    }

    $sqlStmt = $conn->prepare("SELECT user_name, front_name, last_name, city, zip_code, email_adress FROM person WHERE user_name LIKE '%$q%'");

    $sqlStmt->execute();
    $sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $sqlStmt->fetchAll();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  echo '<table class = "usersTable">
  <tr>
  <th>Username</th>
  <th>Firstname</th>
  <th>Lastname</th>
  <th>City</th>
  <th>Zip</th>
  <th>Email</th>
  </tr>';
  foreach ($result as $value) {
      echo "<tr>";
      echo "<td>" . $value['user_name'] . "</td>";
      echo "<td>" . $value['front_name'] . "</td>";
      echo "<td>" . $value['last_name'] . "</td>";
      echo "<td>" . $value['city'] . "</td>";
      echo "<td>" . $value['zip_code'] . "</td>";
      echo "<td>" . $value['email_adress'] . "</td>";
      echo "</tr>";
  }
  echo "</table>";


  $conn = null;
?>
