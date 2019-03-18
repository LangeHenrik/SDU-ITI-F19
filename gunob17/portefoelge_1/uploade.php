<?php
  require "header.php";
 ?>

 <main>
   <?php
   if (isset($_SESSION['userid'])) {
     echo '<form class="upload_form" action="includes\uploade.inc.php" method="post" enctype="multipart/form-data">
          <input type="file" name="file" value="">
          <button type="submit" name="uploade_submit">Uploade</button>';
   }
   else {
     echo '<p class="login-status">You are corrently not logged in and can there for not uploade files</p>';
   }
    ?>

</form>

 </main>

 <?php

  ?>
