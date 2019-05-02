<?php
include '../app/views/partials/menu.php';

foreach($viewbag['pictures'] as $picture) :
?>
<br><br>
<div class="content" id="content">
    <h2><?=$picture['photo_header']?></h2>
    <img src='data:image/<?=substr($picture['photo_type'], 6)?>;<?=$picture['photo_image']?>' alt="<?=$picture['photo_header']?>" />
    <h4><?=json_encode($picture['photo_text'], JSON_PRETTY_PRINT)?></h4>
    <p>Uploaded by: <?=json_encode($picture['photo_user'])?></p>
</div>

<?php

endforeach;
include '../app/views/partials/foot.php'; ?>
