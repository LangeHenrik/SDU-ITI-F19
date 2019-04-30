<?php

foreach ($viewbag['pictures'] as $picture) :
?>

<div>
  <h2><?=$picture['title']?></h2>
  <p><?=$picture['description']?></p>
  <img src="<?=picture['image']?>" alt="<?=$picture['title']?>">
</div>

<?php
endforeach;
