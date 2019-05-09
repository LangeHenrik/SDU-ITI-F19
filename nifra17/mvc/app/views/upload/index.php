<?php include '../app/views/partials/menu.php'; ?>

<form action="upload/upload" enctype="multipart/form-data" class="uploadPictureForm" method="post">

  <label for="image">Picture file</label>
  <br>
  <input type="file" name="image">
  <br>

  <label for="pictureName">Picture  name</label>
  <br>
  <input type="text" name="pictureName">
  <br>

  <label for="pictureDesc">Picture description</label>
  <br>
  <textarea name="pictureDesc" rows="5" cols="50"></textarea>
  <br>

  <input type="submit" value="Upload" name="submit" class="mainButton">
</form>
