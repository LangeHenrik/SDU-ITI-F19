<?php

use Resources\views\partials\PhotoPartial;
?>

<?php
\Resources\views\partials\HeadPartial::show($viewData);
?>
    <article>
        <h2>Profile</h2>

        <div class="profile-image-form">
            <h3>Upload new image</h3>
            <form action="/photos/new" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title">
                </div>

                <div class="form-group">
                    <label for="caption">Caption</label>
                    <input type="text" name="caption" id="caption">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image">
                </div>

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