<?php

use Resources\views\partials\PhotoPartial;
?>

<?php
\Resources\views\partials\HeadPartial::show($viewData);
?>
    <article>
        <h2>Profile</h2>

        <?php if (count($viewData["_errors"]) > 0): ?>
            <div class="error">
                <?php foreach ($viewData["_errors"] as $error): ?>
                <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


        <div class="profile-image-form">
            <h3>Upload new image</h3>
            <form action="/photos/new" method="POST" enctype="multipart/form-data" onsubmit="return validateAll(this)">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" onblur="validate(this)">
                </div>
                <div class="error hidden" id="title-error"></div>

                <div class="form-group">
                    <label for="caption">Caption</label>
                    <input type="text" name="caption" id="caption" onblur="validate(this)">
                </div>
                <div class="error hidden" id="caption-error"></div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" onblur="validate(this)">
                </div>
                <div class="error hidden" id="image-error"></div>

                <div class="form-group">
                    <button>Upload</button>
                </div>
            </form>
        </div>

        <h3>Your images</h3>
        <div class="user-photos cards">
            <?php

            foreach ($viewData["photos"] as $photo) {
                PhotoPartial::show($photo, true);
            }

            ?>
        </div>
    </article>
<?php
\Resources\views\partials\FooterPartial::show();
?>