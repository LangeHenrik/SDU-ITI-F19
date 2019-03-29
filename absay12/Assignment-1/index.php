<?php
  session_start();
  require_once 'include/config.php';
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,
    $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $getPictureStmt = $conn->prepare("SELECT person, title, description, picture_file FROM picture ORDER BY date_uploaded DESC LIMIT 20");
    $queryExecuted = $getPictureStmt->execute();
    $getPictureStmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $getPictureStmt->fetchAll();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>
<!DOCTYPE html> 
<html lang="da"> 
<head> 
  <meta charset="utf-8"> 
  <title>Absay12 - Index</title> 
  <link rel="stylesheet" href="css/reset.css"> 
    <link rel="stylesheet" href="css/grid.css"> 
  <link rel="stylesheet" href="css/core.css"> 
  <link rel="stylesheet" href="css/rwd.css"> 
</head> 
<body> 
<!--Navigation-->
<div class="row col100">
  <div><?php include 'include/nav.php';?></div>
</div> 
<div class="container">
        <?php
        foreach ($result as $value)  {
          $picTmp = $value['picture_file'];
          $personTmp = $value['person'];
          $titleTmp = $value['title'];
          $descTmp = $value['description'];
          echo '<br>';
          echo "<img src='img/$picTmp' alt='' class='picturesImg'>";
          echo '<br>';
          echo '<p class="img_info">Title</p>';
          echo "<p class='titleP'>$titleTmp</p>";
          echo '<br>';
          echo '<p class="img_info">Posted by</p>';
          echo "<p class ='personP'>$personTmp</p>";
          echo '<br>';
          echo '<p class="img_info">Description</p>';
          echo "<p class='descP'>$descTmp</p>";
          echo '<br>';
          echo '<hr>';
        }
        ?>
</div>
</body> 
</html>