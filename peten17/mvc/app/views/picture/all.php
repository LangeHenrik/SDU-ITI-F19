<?php

include '../app/views/partials/header.php';
?>
<form class="addPost" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="submit" name="addPost" value="Add post">
</form>

<?php

foreach($viewbag as $picture) :
?>
<div class="content">
<div class= "post_container">
    <p><?=$picture['comment']?></p>
    <img src="<?=$picture['image_path']?>" />
</div>
</div>
<?php
endforeach;

include '../app/views/partials/foot.php';




