<?php
\Resources\views\partials\HeadPartial::show($viewData);
?>
<article>
    <h2>Register</h2>
    <?php if(isset($viewData["_errors"])): ?>
        <div class="error">
            <h4>Please fix the following errors:</h4>
            <?php foreach ($viewData["_errors"] as $error): ?>
            <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="/register" method="POST" onsubmit="return validateAll(this)">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" onblur="validate(this)">
        </div>
        <div class="error-inline hidden" id="username-error"></div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" onblur="validate(this)">
        </div>
        <div class="error-inline hidden" id="password-error"></div>

        <div class="form-group">
            <label for="password2">Password (confirm)</label>
            <input type="password" name="password2" id="password2" onblur="validate(this)">
        </div>
        <div class="error-inline hidden" id="password2-error"></div>

        <div class="form-group">
            <label for="firstName">First name</label>
            <input type="text" name="firstName" id="firstName" onblur="validate(this)">
        </div>
        <div class="error-inline hidden" id="firstName-error"></div>

        <div class="form-group">
            <label for="lastName">Last name</label>
            <input type="text" name="lastName" id="lastName" onblur="validate(this)">
        </div>
        <div class="error-inline hidden" id="lastName-error"></div>

        <div class="form-group">
            <label for="zip">Zip</label>
            <input type="number" name="zip" id="zip" max="9999" min="0" onblur="validate(this)">
        </div>
        <div class="error-inline hidden" id="zip-error"></div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" onblur="validate(this)">
        </div>
        <div class="error-inline hidden" id="city-error"></div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" onblur="validate(this)">
        </div>
        <div class="error-inline hidden" id="email-error"></div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" onblur="validate(this)">
        </div>
        <div class="error-inline hidden" id="phone-error"></div>

        <div class="form-group">
            <button>Register</button>
        </div>
    </form>


</article>
<?php
\Resources\views\partials\FooterPartial::show();
?>

