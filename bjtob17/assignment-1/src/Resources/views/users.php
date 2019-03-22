<?php
\Resources\views\partials\HeadPartial::show($viewData);
?>
<article>
    <h2>All users</h2>
    <div class="users cards">
        <?php foreach($viewData["users"] as $user): ?>
            <?php \Resources\views\partials\UserPartial::show($user); ?>
        <?php endforeach; ?>
    </div>

</article>
<?php
\Resources\views\partials\FooterPartial::show();
?>