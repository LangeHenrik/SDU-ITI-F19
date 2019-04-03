<!DOCTYPE html>
<html>
<head>
  <title>Register new user</title>
  <script src="Registeruser.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="Register">

<form action="includes/signup.inc.php" method="post" onsubmit="return checkFields()">
  <input type="text" name="firstname" placeholder="Firstname" id="first_name">
  <br>
  <input type="text" name="lastname" placeholder="Lastname" id="last_name">
  <br>
  <input type="text" name="email" placeholder="E-mail" id="email">
  <br>
  <input type="text" name="username" placeholder="Username" id="username">
  <br>
  <input type="password" name="password" placeholder="Password" id="password">
  <br>
  <input type="password" name="repeatpassword" placeholder="Repeat Password" id="password_repeat">
  <br>
  <input type="text" name="zipcode" placeholder="Zipcode" id="zip">
  <br>
  <input type="text" name="phonenumber" placeholder="Phonenumber" id="phone">
  <br>
  <input type="text" name="city" placeholder="City" id="city">
  <br>
  <button type="submit" name="submit" value="submit">Signup</button>

</form>

</div>

</body>
</html>
