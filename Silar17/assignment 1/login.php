<?php
session_start();
?>
<html>
<title>Silar17-assignment1</title>
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

<!-- Page content -->
<div class="-content -padding" style="max-width:1564px">

<!-- login Section -->
  <div class="-container -padding-32" id="contact">
    <h3 class="-border-bottom -border-light-grey -padding-16">login</h3>
	<?php
		if (isset($_SESSION['username'])) {
	?>
	<h3 class="-border-bottom -border-light-grey -padding-16">You are logged in</h3>
	<?php } elseif (isset($_SESSION['logintry'])) {
		if ($_SESSION['logintry'] > 0){  ?>
	<h3 class="-border-bottom -border-light-grey -padding-16">Wrong username or password</h3>
	<?php } }?>
    <p>Please log in or register to use the site</p>
    <form action="fun-login.php" method="POST">
      <input class="-input -border" type="text" placeholder="Username" required id="login_name"  name="login_name">
      <input class="-input -section -border" type="Password" placeholder="Password" required id="login_password" name="login_password">
      <button class="-button -black -section" type="submit">
        <i></i> Login
      </button>
    </form>
  </div>
  
  <div class="-container -padding-32" id="contact">
    <h3 class="-border-bottom -border-light-grey -padding-16">Register </h3>
    <p>something about register</p>
    <form class="-checked" onsubmit="return loginSubmit()" action="fun-register.php" method="POST">
	  <p id = "usernameSpec"></p>
      <input class="-input -border " type="text" placeholder="Username" required name="Username" id="username" oninput = "checkUsername(this)">
	  <p id = "passwordSpec"></p>
	  <input class="-input -section -border " type="password" placeholder="Password" required name="Password" id="password" oninput = "checkPassword(this)">
	  <p id = "repeatSpec"></p>
	  <input class="-input -section -border " type="password" placeholder="Repeat Password" required name="RepeatPassword" id="repeatPassword" oninput = "checkRepeatPassword(this)">
      <p id = "firstnameSpec"></p>
	  <input class="-input -section -border" type="text" placeholder="Firstname" required name="Firstname" id="firstname" oninput = "checkFirstname(this)">
      <p id = "lastnameSpec"></p>
	  <input class="-input -section -border" type="text" placeholder="Lastname" required name="Lastname" id="lastname" oninput = "checkLastname(this)">
      <p id = "zipSpec"></p>
	  <input class="-input -section -border " type="number" placeholder="Zip" required name="Zip" id="zip" oninput = "checkZip(this)"  >
	  <p id = "citySpec"></p>
	  <input class="-input -section -border " type="text" placeholder="City" required name="City" id="city">
      <p id = "emailSpec"></p>
	  <input class="-input -section -border " type="email" placeholder="Email" required name="Email" id="email" oninput = "checkEmail(this)">
	  <p id = "phoneSpec"></p>
	  <input class="-input -section -border " type="tel" placeholder="Phone number" required name="Phone" id="phone" oninput = "checkPhone(this)">
	  <button class="-button -black -section" type="submit">
        <i></i> Register
      </button>
    </form>
  </div>
  
  

<!-- End page content -->
</div>


<!-- Footer -->
<footer class="-center -black -padding-16">
  <p>Powered by <a href="https://sso.sdu.dk/" title="Silar17-assignment1" target="_blank" class="-hover-text-green">Larsen</a></p>
</footer>

</body>
</html>