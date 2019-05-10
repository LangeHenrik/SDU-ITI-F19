<?php

include '../app/views/partials/menu.php';

foreach($viewbag['pictures'] as $picture) :
?>

<div style="background-color: lightblue;">
    <h2><?=$picture['title']?></h2>
    <p><?=$picture['description']?></p>
    <img src="<?=$picture['image']?>" alt="<?=$picture['title']?>" />
</div>

<?php
endforeach;

include '../app/views/partials/foot.php';




