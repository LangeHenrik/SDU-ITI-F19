<?php

session_start();
$sql = "";
 //We have four uploadsites and four upload tables
include 'Includes/dbh_inc.php';

$sql = "SELECT * FROM images1 ORDER BY idPic desc limit 4000";
$stmt = $connect->prepare($sql);

$stmt->execute();
//Execute the statement
if ($stmt->rowCount() > 0) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $fileExt = explode('.', $row['path']);
    if ($fileExt[3] == 'mp4') {
      echo "<div class='wrapperscale'>";
      echo "<article class='articlescale'>";
      echo "<video class='video-article' poster 'image.gif' autoplay controls>";
      echo "<source src='Assignment1/".$row['path']."'type='video/mp4'>";
      echo "</video>";
      echo "<p><b>".$row['uidusers']."</b></p>";
      echo "<p>".$row['tex']."</p>";
      echo "</article>";
      echo "</div>";
    }
    else {
      echo "<div class='wrapperscale'>";
      echo "<article class='articlescale'>";
      echo "<p><b>".$row['uidusers']."</b></p>";
      echo "<img class='img-article' src='Assignment1/".$row['path']."'>";
      echo "<p>".$row['tex']."</p>";
      echo "</article>";
      echo "</div>";
    }
  }
}

exit();
