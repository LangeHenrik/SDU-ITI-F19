<?php

include '../app/views/partials/menu.php';

?>

<form method="POST" action="upload/uploadImage" enctype="multipart/form-data">
    <label for="imageTitle">Image title</label><br>
    <input type="text" name="imageTitle"><br>
    <label for="imageDescription">Image description</label><br>
    <input type="text" name="imageDescription"><br>
    <label for="image">Image file</label><br>
    <input type="file" name="image"><br>
    <input type="submit" value="Upload" name="upload">
</form>