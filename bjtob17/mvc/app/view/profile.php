<?php
\app\view\partials\HeaderPartial::show($viewBag);

$photoAction = $viewBag["photo_action"];
?>
    <div>
        <h2 class="title is-2"><?= $viewBag["page_title"] ?></h2>
        <?php if (count($viewBag["_errors"]) > 0): ?>
            <div class="error">
                <?php foreach ($viewBag["_errors"] as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="profile-image-form">
            <h3>Upload new image</h3>
            <form action="<?= $photoAction ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateAll(this)">
                <div class="field">
                    <label for="title">Title</label>
                    <input class="input" type="text" name="title" id="title" onblur="validate(this)">
                </div>
                <div class="error hidden" id="title-error"></div>

                <div class="field">
                    <label for="caption">Caption</label>
                    <input class="input" type="text" name="caption" id="caption" onblur="validate(this)">
                </div>
                <div class="error hidden" id="caption-error"></div>

                <div class="field">
                    <label for="image">Image</label>
                    <input class="input" type="file" name="image" id="image" onblur="validate(this)">
                </div>
                <div class="error hidden" id="image-error"></div>

                <div class="field">
                    <button>Upload</button>
                </div>
            </form>
        </div>

        <h2 class="is-size-2">Your images</h2>
        <?php
        \app\view\partials\ColumnPartial::show(function ($items) {
            \app\view\partials\PicturePartial::show($items, false);
        }, $viewBag["photos"])
        ?>

    </div>
<?php
\app\view\partials\FooterPartial::show($viewBag);

