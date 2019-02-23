<?php
\Resources\views\partials\HeadPartial::show($viewData);
?>
<article>
    <h2>Register</h2>

    <?php
    if (isset($viewData["_errors"]) && count($viewData["_errors"]) > 0) {
        print_r($viewData["_errors"]);
    }
    ?>
    <form action="/register" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <label for="password2">Password (confirm)</label>
            <input type="password" name="password2" id="password2">
        </div>

        <div class="form-group">
            <button>Register</button>
        </div>
    </form>


</article>
<?php
\Resources\views\partials\FooterPartial::show();
?>

