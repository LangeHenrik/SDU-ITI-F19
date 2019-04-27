<?php
\app\view\partials\HeaderPartial::show($viewBag);
?>
    <div>

        <h2 class="is-size-2">All users</h2>
        <div class="cards">
            <?php
            foreach ($viewBag["users"] as $user) {
                \app\view\partials\UserPartial::show($user);
            }
            ?>
        </div>

    </div>
<?php
\app\view\partials\FooterPartial::show($viewBag);

