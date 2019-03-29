<?php
  try {
    require_once 'include/config.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }
    $sqlStmt = $conn->prepare("SELECT user_name, front_name, last_name, zip_code, city, phone_number, email_adress FROM person");
    $sqlStmt->execute();
    $sqlStmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $sqlStmt->fetchAll();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
   ?>
<!DOCTYPE html> 
<html lang="da"> 
<head> 
  <meta charset="utf-8"> 
  <title>Absay12 - Users</title> 
  <link rel="stylesheet" href="css/reset.css"> 
    <link rel="stylesheet" href="css/grid.css"> 
  <link rel="stylesheet" href="css/core.css"> 
  <link rel="stylesheet" href="css/rwd.css"> 
<?php include 'include/config.php' ?>
</head> 
<body> 
<!--Navigation-->
<div class="row col100">
  <div><?php include 'include/nav.php';?></div>
</div> 

<div class="after_nav">
    <h1>Users.</h1>
    </div>

<div class="row col100">
   <?php 
  echo '<table id = "customers">
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
</div>

</body> 
</html>