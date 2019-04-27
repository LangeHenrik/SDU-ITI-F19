<?php
\app\view\partials\HeaderPartial::show($viewBag);

$loginAction = $viewBag["login_action"];
?>
<div>
    <h2 class="is-size-2">Login</h2>
    <?php if (isset($viewBag["_errors"]) && count($viewBag["_errors"]) > 0): ?>
        <div class="error">
            <h4>Please fix the following errors:</h4>
            <?php foreach ($viewBag["_errors"] as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="<?= $loginAction ?>" method="POST">
        <div class="field">
            <label for="username">Username:</label>
            <input class="input" type="text" name="username" id="username">
        </div>

        <div class="field">
            <label for="password">Password:</label>
            <input class="input" type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <button class="button is-link">Login</button>
        </div>
    </form>
</div>
<?php
\app\view\partials\FooterPartial::show($viewBag);

