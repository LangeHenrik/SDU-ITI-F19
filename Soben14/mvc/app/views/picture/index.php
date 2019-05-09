<?php include '../app/views/partials/menu.php'; ?>

<div class="pictureContainer">
    <?php
    foreach ($viewbag as $value)  {
      $picTmp = $value['picture_file'];
      $personTmp = $value['person'];
      $titleTmp = $value['title'];
      $descTmp = $value['description'];


      echo '<h2> Title: '.$titleTmp.'</h2>';
      echo "<img src='$picTmp'>";
      echo '<legend> Description </legend>';
	  echo '<fieldset>'.$descTmp.'</fieldset>';
	  echo '<h3> Uploaded by: '.$personTmp.'</h3>';
      echo '<hr>';
    }
    ?>
</div>
