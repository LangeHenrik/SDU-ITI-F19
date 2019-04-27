<?php
\app\view\partials\HeaderPartial::show($viewBag);
?>
    <div>

        <h2 class="is-size-2">All images</h2>
        <div class="user-photos cards">
            <?php
            foreach ($viewBag["photos"] as $photo) {
                \app\view\partials\PicturePartial::show($photo, false);
            }
            ?>
        </div>

    </div>
<?php
\app\view\partials\FooterPartial::show($viewBag);

