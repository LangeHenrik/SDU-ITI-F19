<?php include '../app/views/partials/menu.php'; ?>

<!-- Page content -->
<div class="-content -padding" style="max-width:1564px">


<!-- upload Section -->
  <div class="-container -padding-32" id="contact">
    <h3 class="-border-bottom -border-light-grey -padding-16">Upload pictures</h3>
    <p>Here you can opload picture to the page</p>
    <form action="/silar17/mvc/public/upload/upload/" method="POST" enctype="multipart/form-data" id="upload-picture">
	  <input class="-input -border" type="file" name="picture" id="uploadPicture">
      <input class="-input -section -border" type="text" placeholder="Title" required name="title">
      <textarea class="-input -section -border -comment" placeholder="Comment" name="comment" form="upload-picture" id="comment"></textarea>
	  <button class="-button -black -section" type="submit">
       <i></i> Upload picture
      </button>
    </form>
  </div>
<!-- End page content -->
</div>

<!-- Footer -->
<?php include '../app/views/partials/footer.php'; ?>