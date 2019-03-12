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

  <!-- Contact Section -->
  <div class="-container -padding-32" id="contact">
    <h3 class="-border-bottom -border-light-grey -padding-16">Contact</h3>
    <p>Lets get in touch and talk about your next project.</p>
    <form onsubmit="return contact-submit()" action="contact.php" method="post">
      <input class="-input -border" type="text" placeholder="Name" required name="Name" id="name" onblur = "checkName(this)">
      <input class="-input -section -border" type="text" placeholder="Email" required name="Email" id="email">
      <input class="-input -section -border" type="text" placeholder="Subject" required name="Subject" id="subject">
      <input class="-input -section -border" type="text" placeholder="Comment" required name="Comment" id="comment">
      <button class="-button -black -section" type="submit">
        <i class="fa fa-paper-plane"></i> SEND MESSAGE
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
  <p>Powered by <a href="https://sso.sdu.dk/" title="Silar17-assignment1" target="_blank" class="-hover-text-green">.css</a></p>
</footer>

</body>
</html>


