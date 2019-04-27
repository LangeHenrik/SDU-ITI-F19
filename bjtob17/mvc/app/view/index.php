<?php
\app\view\partials\HeaderPartial::show($viewBag);
?>
hej! HTML!!!
<?= isset($viewBag["id"]) && $viewBag["id"]; ?>
<?= isset($viewBag["name"]) && $viewBag["name"]; ?>
<?php
\app\view\partials\FooterPartial::show($viewBag);

