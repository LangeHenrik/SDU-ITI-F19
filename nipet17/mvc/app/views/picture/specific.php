<?php
include '../app/views/partials/menu.php';
?>

<br><br><br>
  <h2>Pictures uploaded by: <?= // ?></h2>
<br><br>

<?php
foreach($viewbag['specific'] as $user) :
?>
<br><br>
<div class="content" id="content">
    <h3><?=$user['login_username']?></h3>

    <h2><?=$user['photo_header']?></h2>
    <img src='data:image/<?=substr($uuser['photo_type'], 6)?>;<?=$user['photo_image']?>' alt="<?=$user['photo_header']?>" />
    <h4><?=json_encode($user['photo_text'], JSON_PRETTY_PRINT)?></h4>
</div>

</div>

<?php

endforeach;
include '../app/views/partials/foot.php'; ?>
