<?php
require 'header.php';
include 'includes/dbh.php';
if (isset($_SESSION['userid'])) {
  $stmt = $conn->prepare("SELECT username from users ");
  if (!$stmt) {
    header("Location: ../signup.php?error=sqlerror");
    exit();
  }
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
    echo '<ul>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo $row['username'].'<br>';
    }
  echo'</ul>';
}}
 ?>
