<?php
include '../app/views/partials/header.php';?>

<form class="addPost" action= "/peten17/mvc/public/home/addpost" method="post">
      <input type="submit" name="addPost" value="Add post">
</form>

<?php

foreach($viewbag as $picture) :
?>
<div class="content">
<div class= "post_container">
    <h2><?=$picture['image_title']?></h2>
    <p><?=$picture['image_desc']?></p>
    <img src="<?=$picture['image_file']?>" />
</div>
</div>
<?php
endforeach;

include '../app/views/partials/foot.php';




