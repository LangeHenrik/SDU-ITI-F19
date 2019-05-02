<?php
include '../app/views/partials/menu.php';

foreach($viewbag['users'] as $user) :
?>
<br><br>
<div class="content" id="content">
    <h3><?=$user['login_username']?></h3>

    <p>Name: &nbsp;&nbsp;         <?= json_encode($user['login_name'], JSON_PRETTY_PRINT)?></p>
    <p>Email: &nbsp;&nbsp;        <?= json_encode($user['login_email'], JSON_PRETTY_PRINT)?></p>
    <p>Phone: &nbsp;              <?= json_encode($user['login_phone'], JSON_PRETTY_PRINT)?></p>
    <p>City: &nbsp; &nbsp; &nbsp; <?= json_encode($user['login_zip'], JSON_PRETTY_PRINT)?> ,
                                  <?= json_encode($user['login_city'], JSON_PRETTY_PRINT)?></p>

</div>

<?php

endforeach;
include '../app/views/partials/foot.php'; ?>
