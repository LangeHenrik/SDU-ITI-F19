<?php include '../app/views/partials/menu.php'; ?>

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
    <form action="/silar17/mvc/public/login/login" method="POST">
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
    <form class="-checked" onsubmit="return loginSubmit()" action="/silar17/mvc/public/login/register/" method="POST">
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
<?php include '../app/views/partials/footer.php'; ?>