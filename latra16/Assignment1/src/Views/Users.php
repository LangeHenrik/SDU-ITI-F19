<?php

    $page = 'users';
    Views\Core\Header::view($page);

?>

<div class="content users">

    <div class="users">
        <?php foreach ($data["users"] as $user): ?>
            <div class="user">
                <div class="username"><?= $user->username ?></div>
                <div class="name"><?= $user->firstname ?> <?= $user->lastname ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    
</div>

<?php

    Views\Core\Footer::view();

?>