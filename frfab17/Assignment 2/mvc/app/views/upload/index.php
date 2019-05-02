<?php

include '../app/views/partials/menu.php';

?>
<html>

<body>
    <h1>Upload an image</h1>
    <form method="POST" action="upload/uploadImage" enctype="multipart/form-data">
        <label for="imageTitle">Title</label><br>
        <input type="text" name="imageTitle"><br>
        <label for="imageDescription">Description</label><br>
        <input type="text" name="imageDescription"><br>
        <label for="image">File</label><br>
        <input type="file" name="image"><br>
        <input type="submit" value="Upload" name="upload">
    </form>
</body>

</html>