<?php
session_start();
?>

<html>
<title>Silar17-assignment1</title>
<!-- may not be neseary <meta charset="UTF-8"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="javaScript.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<body>

<!-- Navgiation bar (sit on top) -->
<div class="-top">
  <div class="-nav">
    <a href="index.php" class="-bar-item -button">
	<b>Larsen</b> Solutions</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="-right">
	<?php if (isset($_SESSION['username'])){ ?> 
		<a href="picture.php" class="-bar-item -button">Pictures</a>
		<a href="picture-upload.php" class="-bar-item -button">Upload</a>
		<a href="user.php" class="-bar-item -button">Users</a>
		<a href="contact.php" class="-bar-item -button">Contact</a>
		<a href="login.php" class="-bar-item -button"> Login</a>
		<a href="fun-logout.php" class="-bar-item -button"> logout</a>
	<?php } else { ?>	
	  <a href="login.php" class="-bar-item -button"> Login</a>
	 <?php } ?>
    </div>
  </div>
</div>

<!-- Header -->
<header class="-display-container -content -wide" style="max-width:1500px;" id="home">
  <img class="-image" src="/images/architect.jpg" alt="Architecture" width="1500" height="800">
  <div class="-display-middle -margin-top -center">
    <h1 class="-header1"><span class="-header2"><b>Larsen</b></span> <span class="-header3">Solutions</span></h1>
  </div>
</header>

<!-- Page content -->
<div class="-content -padding" style="max-width:1564px">

<!-- End page content -->
</div>


<!-- Footer -->

<footer class="-center -black -padding-16">
  <p>Powered by <a href="https://sso.sdu.dk/" title="Silar17-assignment1" target="_blank" class="-hover-text-green">.css</a></p>
</footer>

</body>
</html>
