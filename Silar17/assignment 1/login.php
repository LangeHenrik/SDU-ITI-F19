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
    <h3 class="-border-bottom -border-light-grey -padding-16">login</h3>
    <p>something about login</p>
    <form onsubmit="return login-submit()" action="login.php" method="POST">
      <input class="-input -border" type="text" placeholder="Username" required id="login_name" >
      <input class="-input -section -border" type="Password" placeholder="Password" required id="login_password" >
      <button class="-button -black -section" type="submit">
        <i class="fa fa-paper-plane"></i> SEND MESSAGE
      </button>
    </form>
  </div>
  
  <div class="-container -padding-32" id="contact">
    <h3 class="-border-bottom -border-light-grey -padding-16">Register </h3>
    <p>something about register</p>
    <form class="-checked" onsubmit="return contact-submit()" action="contact.php" target="_blank">
      <input class="-input -border " type="text" placeholder="Username" required name="Username" id="username" onblur = "checkUsername(this)" >
      <input class="-input -section -border " type="password" placeholder="Password" required name="password" id="password" onblur = "checkPassword(this)">
	  <input class="-input -section -border " type="password" placeholder="Repeat Password" required name="repeatPassword" id="repeatPassword" onblur = "checkRepeatPassword(this)">
      <input class="-input -section -border" type="text" placeholder="Firstname" required name="firstname" id="firstname">
      <input class="-input -section -border" type="text" placeholder="Lastname" required name="lastname" id="lastname">
      <input class="-input -section -border " type="text" placeholder="Zip" required name="zip" id="zip" onchange = "checkZip(this)" >
      <input class="-input -section -border " type="text" placeholder="City" required name="city" id="city" onchange = "checkCity(this)">
	  <input class="-input -section -border " type="email" placeholder="Email" required name="email" id="email" onblur = "checkEmail(this)">
      <input class="-input -section -border " type="number" placeholder="Phone number" required name="phone" id="phone" onblur = "checkPhone(this)">
	  <button class="-button -black -section" type="submit">
        <i class="fa fa-paper-plane"></i> SEND MESSAGE
      </button>
    </form>
  </div>
  
  

<!-- End page content -->
</div>


<!-- Footer -->
<footer class="-center -black -padding-16">
  <p>Powered by <a href="https://sso.sdu.dk/" title="Silar17-assignment1" target="_blank" class="-hover-text-green">.css</a></p>
</footer>

</body>
</html>