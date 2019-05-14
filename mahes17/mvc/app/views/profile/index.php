<?php

include '../app/views/partials/menu.php'; ?>

<div>
    <?php
    foreach ($viewbag as $value) {
        $image = $value['img_blob'];
        $user = $value['user'];
        $title = $value['title'];
        $description = $value['description'];

        ?>
        <br>
        <p>Title: <?php echo $title ?></p>
        <br>
        <img src='<?php echo $image ?>'>
        <br>
        <p>Posted by: <?php echo $user ?></p>
        <br>
        <p>Description: <?php echo $description ?></p>
        <hr>
    <?php
}
?>
</div>