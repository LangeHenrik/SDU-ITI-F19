<?php
\app\view\partials\HeaderPartial::show($viewBag);
?>
    <div>

        <h2 class="title is-2"><?= $viewBag["page_title"] ?></h2>
        <?php
        \app\view\partials\ColumnPartial::show(function ($items) {
            \app\view\partials\UserPartial::show($items);
        }, $viewBag["users"])
        ?>

    </div>
<?php
\app\view\partials\FooterPartial::show($viewBag);

