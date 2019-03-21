<?php

    $page = 'photos';
    Views\Core\Header::view($page);

?>

<div class="content photos">
    
    <div class="photos">
        <?php foreach ($data["photos"] as $photo): ?>
            <figure class="photo" onclick="getDetails(<?= $photo->photoId ?>)">
                <img src="assets/img/<?= $photo->photoName ?>">
                <div class="photo_overlay"></div>
                <div class="details">
                    <div class="details_inner">
                        <div class="uploader"><?= $photo->uploader->username ?></div>
                        <div class="date"><?= $photo->uploadDate ?></div>
                    </div>
                </div>
            </figure>
        <?php endforeach; ?>
    </div>
    
</div>

<?php

    Views\Core\Footer::view();

?>