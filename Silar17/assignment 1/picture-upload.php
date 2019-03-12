<html>
<title>Silar17-assignment1</title>
<!-- may not be neseary <meta charset="UTF-8"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="javaScript.js"></script>
<link rel="stylesheet" type="text/css" href="Style.css">
<body>

<!-- Navgiation bar (sit on top) -->
<div class="-top">
  <div class="-bar -white -wide -padding -card">
    <a href="index.php" class="-bar-item -button">
	<b>Larsen</b> Solutions</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="-right -hide-small">
	  <a href="picture.php" class="-bar-item -button">Pictures</a>
      <a href="picture-upload.php" class="-bar-item -button">Upload</a>
      <a href="user.php" class="-bar-item -button">Users</a>
      <a href="contact.php" class="-bar-item -button">Contact</a>
	  <a href="login.php" class="-bar-item -button"> Login</a>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="-content -padding" style="max-width:1564px">

<!-- upload Section -->
  <div class="-container -padding-32" id="contact">
    <h3 class="-border-bottom -border-light-grey -padding-16">Upload pictures</h3>
    <p>Here you can opload picture to the page</p>
    <form action="fun-upload.php" method="POST" enctype="multipart/form-data" id="upload-picture">
	  <input class="-input -border" type="file" name="picture" id="uploadPicture">
      <input class="-input -section -border" type="text" placeholder="Title" required name="Title">
      <textarea class="-input -section -border -comment" type="text" placeholder="Comment" name="comment" form="upload-picture" id="comment";> </textarea>
	  <button class="-button -black -section" type="submit">
       <i class="fa fa-paper-plane"></i> Upload picture
      </button>
    </form>
  </div>

<!-- Image of location/map -->
<div class="-container">
  <img src="/images/map.jpg" class="-image" style="width:100%">
</div>


<!-- End page content -->
</div>

<!-- Footer -->
<footer class="-center -black -padding-16">
  <p>Solution by <a href="https://sso.sdu.dk/" title="Silar17-assignment1" target="_blank" class="-hover-text-green">Larsen</a></p>
</footer>

</body>
</html>