<?php include '../app/views/partials/menu.php'; ?>

<div class="pictureContainer">
    <?php
    foreach ($viewbag as $value)  {
      $picTmp = $value['picture_file'];
      $personTmp = $value['person'];
      $titleTmp = $value['title'];
      $descTmp = $value['description'];


      echo '<br>';
      //echo "<img src=''data:image/jpeg;base64,$picTmp'.' alt='' class='picturesImg'>";
      //echo '<img src='."data:image/jpeg;base64,$picTmp".'>';
      echo "<img src='$picTmp'>";
      //echo base64_decode($picTmp);
      echo '<br>';
      echo '<p class = "picturesP">Title</p>';
      echo "<p class='titleP'>$titleTmp</p>";
      echo '<br>';
      echo '<p class = "picturesP">Posted by</p>';
      echo "<p class ='personP'>$personTmp</p>";
      echo '<br>';
      echo '<p class = "picturesP">Description</p>';
      echo "<p class='descP'>$descTmp</p>";
      echo '<br>';
      echo '<hr>';
    }
    ?>
</div>
