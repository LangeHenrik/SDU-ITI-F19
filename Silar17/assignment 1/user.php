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

<!-- About Section -->
  <div class="-container -padding-32" id="about">
    <h3 class="-border-bottom -border-light-grey -padding-16">Users</h3>
    <p>here you will find a complete list of users
    </p>
  </div>

  <div class="-row-padding -grayscale">
    <div class="-col l3 m6 -margin-bottom">
      <img src="/images/team2.jpg" alt="John" style="width:100%">
      <h3>John Doe</h3>
      <p class="-opacity">CEO & Founder</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="-button -light-grey -block">Contact</button></p>
    </div>
    <div class="-col l3 m6 -margin-bottom">
      <img src="/images/team1.jpg" alt="Jane" style="width:100%">
      <h3>Jane Doe</h3>
      <p class="-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="-button -light-grey -block">Contact</button></p>
    </div>
    <div class="-col l3 m6 -margin-bottom">
      <img src="/images/team3.jpg" alt="Mike" style="width:100%">
      <h3>Mike Ross</h3>
      <p class="-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="-button -light-grey -block">Contact</button></p>
    </div>
    <div class="-col l3 m6 -margin-bottom">
      <img src="/images/team4.jpg" alt="Dan" style="width:100%">
      <h3>Dan Star</h3>
      <p class="-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="-button -light-grey -block">Contact</button></p>
    </div>
  </div>

<!-- End page content -->
</div>


<!-- Footer -->
<footer class="-center -black -padding-16">
  <p>Powered by <a href="https://sso.sdu.dk/" title="Silar17-assignment1" target="_blank" class="-hover-text-green">.css</a></p>
</footer>

</body>
</html>