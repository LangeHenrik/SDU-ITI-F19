<?php

use Resources\views\partials\PhotoPartial;
?>

<?php
\Resources\views\partials\HeadPartial::show($viewData);
?>
<article>
    <h2>Latest photos</h2>
    <div class="user-photos cards">
        <?php

        foreach ($viewData["photos"] as $photo) {
            PhotoPartial::show($photo);
        }

        ?>
    </div>
</article>
<?php
\Resources\views\partials\FooterPartial::show();
?>