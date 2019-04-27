<?php
\app\view\partials\HeaderPartial::show($viewBag);

?>
    <h2 class="title is-2"><?= $viewBag["page_title"] ?></h2>

<?php
\app\view\partials\ColumnPartial::show(function ($items) {
    \app\view\partials\PicturePartial::show($items, false);
}, $viewBag["photos"])
?>

<?php
\app\view\partials\FooterPartial::show($viewBag);

