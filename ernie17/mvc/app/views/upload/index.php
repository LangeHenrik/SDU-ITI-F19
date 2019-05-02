<?php include '../app/views/partials/head.php'; ?>

<?php include '../app/views/partials/header.php'; ?>

<form class="form-upload" method="post" enctype="multipart/form-data" action="upload/uploadPicture">
    <fieldset>
        <legend>Upload</legend>
        <p>Title</p>
        <input type="text" name="header"><br><br>
        <p>Description</p>
        <textarea name="description" rows="5" cols="30"></textarea><br><br>
        <input type="file" name="image-upload"><br><br>
        <button type="btn-upload">Upload</button>
    </fieldset>
</form>

<!-- <?php
    if(isset($respons)) {
        echo "<p class='error-response'> $respons</p>";
    }
 ?> -->

<?php include '../app/views/partials/footer.php'; ?>

<?php include '../app/views/partials/foot.php'; ?>
