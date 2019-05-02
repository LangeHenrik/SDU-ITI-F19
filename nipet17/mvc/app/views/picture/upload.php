<?php

include '../app/views/partials/menu.php';
?>

<br><br>

<div class="content" id="content">
      <?php
        echo '<h1>You are now logged in '.$_SESSION['name'].'. Good for you!</h1><br>';
        echo '<label class="text-danger">'.$_SESSION['imgMsg'].'</label>';
      ?>

      <form class="fifty" method="post" class="upload" action="/nipet17/mvc/public/picture/upload" enctype="multipart/form-data">
        <label class="image" for="image">Image</label><br>
        <input type="file" name="img" id="img">
        <br>
        <label class="header" for="header">Header &nbsp; </label><br>
        <input type="text" size="37" name="header" placeholder="Header here.."/>
        <br><br>
        <textarea name="text"  placeholder="Say something about this image.."></textarea>
        <button type="submit">Upload image</button>
     </form>

</div>
<?php
include '../app/views/partials/foot.php'; ?>
