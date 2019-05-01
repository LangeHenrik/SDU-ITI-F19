<?php  

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="public/css/headerLogincss.css">
</head>

<body>

  <div class="loginBox">
    <form class="loginForm" action="/peten17/mvc/public/user/login" method="post">
      <fieldset>
        <legend>Login</legend>
        <p>Username:</p>
        <input type="text" name="username" value="" id="username"> <br>
        <p>Password:</p>
        <input type="password" name="password" value="" id="password"> <br>
        <br /><input type="submit" name="submit" value="Log in">
        <p>Not a member yet?</p> <a href="/peten17/mvc/public/user/registerUser">Click here to sign up!</a>
      </fieldset>
    </form>

  </div>
</body>

</html>