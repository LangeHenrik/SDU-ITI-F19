<?php
\app\view\partials\HeaderPartial::show($viewBag);

$registerAction = $viewBag["register_action"];
?>
    <div>
        <h2 class="is-size-2">Register</h2>
        <?php if (isset($viewBag["_errors"]) && count($viewBag["_errors"]) > 0): ?>
            <div class="error">
                <h4>Please fix the following errors:</h4>
                <?php foreach ($viewBag["_errors"] as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="<?= $registerAction ?>" method="POST" onsubmit="return validateAll(this)">
            <div class="field">
                <label for="username">Username</label>
                <input class='input' type="text" name="username" id="username" onblur="validate(this)">
            </div>
            <div class="error-inline hidden" id="username-error"></div>

            <div class="field">
                <label for="password">Password</label>
                <input class='input' type="password" name="password" id="password" onblur="validate(this)">
            </div>
            <div class="error-inline hidden" id="password-error"></div>

            <div class="field">
                <label for="password2">Password (confirm)</label>
                <input class='input' type="password" name="password2" id="password2" onblur="validate(this)">
            </div>
            <div class="error-inline hidden" id="password2-error"></div>

            <div class="field">
                <label for="firstName">First name</label>
                <input class='input' type="text" name="firstName" id="firstName" onblur="validate(this)">
            </div>
            <div class="error-inline hidden" id="firstName-error"></div>

            <div class="field">
                <label for="lastName">Last name</label>
                <input class='input' type="text" name="lastName" id="lastName" onblur="validate(this)">
            </div>
            <div class="error-inline hidden" id="lastName-error"></div>

            <div class="field">
                <label for="zip">Zip</label>
                <input class='input' type="number" name="zip" id="zip" max="9999" min="0" onblur="validate(this)">
            </div>
            <div class="error-inline hidden" id="zip-error"></div>

            <div class="field">
                <label for="city">City</label>
                <input class='input' type="text" name="city" id="city" onblur="validate(this)">
            </div>
            <div class="error-inline hidden" id="city-error"></div>

            <div class="field">
                <label for="email">Email</label>
                <input class='input' type="email" name="email" id="email" onblur="validate(this)">
            </div>
            <div class="error-inline hidden" id="email-error"></div>

            <div class="field">
                <label for="phone">Phone</label>
                <input class='input' type="text" name="phone" id="phone" onblur="validate(this)">
            </div>
            <div class="error-inline hidden" id="phone-error"></div>

            <div class="field">
                <div class="control">
                    <button class="button is-link">Register</button>
                </div>
            </div>
        </form>
    </div>
<?php
\app\view\partials\FooterPartial::show($viewBag);

