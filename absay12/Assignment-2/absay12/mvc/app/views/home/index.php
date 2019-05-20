<?php
include '../app/views/partials/header.php';
include '../app/views/partials/nav.php';
?>
<div class="container">
        <?php
          foreach ($viewbag['pictures'] as $value)  {
          $picTmp = $value['picture_file'];
          $personTmp = $value['person'];
          $titleTmp = $value['title'];
          $descTmp = $value['description'];
          echo '<br>';
          echo "<img src='img/$picTmp' alt='' class='picturesImg'>";
          echo '<br>';
          echo '<p class="img_info">Title:</p>';
          echo "<p class='titleP'>$titleTmp</p>";
          echo '<br>';
          echo '<p class="img_info">Posted by:</p>';
          echo "<p class ='personP'>$personTmp</p>";
          echo '<br>';
          echo '<p class="img_info">Description:</p>';
          echo "<p class='descP'>$descTmp</p>";
          echo '<br>';
          echo '<hr>';      
        }
        ?>
</div>
</body> 
</html>



  