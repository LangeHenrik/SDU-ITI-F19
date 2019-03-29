<?php
session_start();
if (isset($_SESSION['userId'])) {
  include 'includes/dbh.inc.php';


  $stmt = $connect -> prepare("SELECT * from images order by idImg desc limit 200 ");
  $stmt -> execute();
  if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo '<div class = "images">';
      echo '<p>Uploaded by: '.$row['uidUsers'].'</p>';
      echo '<br>';

      echo '<img class="" src="'.$row['path'].'" alt="'.$row['name'].'">';
      echo '</div>';
    }
    $connect = null;
  }
}
