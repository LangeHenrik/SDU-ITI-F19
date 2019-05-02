<!-- <form method="POST" action="/Henrik/mvc/public/user/login">
    <label>username</label>
    <br/>
    <input type="text" name="username" id="username" />
    <br/>


    <label>password</label>
    <br/>
    <input type="password" name="password" id="password" />
    <br/>
    <br/>
    <button type="submit">LET ME IN!!</button>
</form> -->

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="../../../public/css/style.css">
  
</head>
<style>
/* user/login page css */
.header h1 {
    text-align: center;
    font-family: sans-serif;
    padding: 10px;
    margin-top: 200px;
}

.loginBox form {
    width: 30%;
    position: absolute;
    left: 35%;
}

.loginBox fieldset {
    font-size: 20px;
    font-family: sans-serif;
}

.loginBox input {
    padding: 8px;
    font-family: sans-serif;
    border: 0px;
    color: black;
}

body {
    background-color: #f2f2f2;
}
</style>
<body>
  <div class="header">
    <h1>Welcome to my website!</h1>
  </div>
  <div class="loginBox">
    <form class="loginForm" action="/peten17/mvc/public/user/login" method="post">
      <fieldset>
        <legend>Login</legend>
        <p>Username:</p>
        <input type="text" name="username" value="" id="username"> <br>
        <p>Password:</p>
        <input type="password" name="password" value="" id="password"> <br>
        <br /><input type="submit" name="submit" value="Log in">
        <p>Not a member yet?</p> <a href="/peten17/mvc/app/views/home/register.php">Click here to sign up!</a>
      </fieldset>
    </form>
  </div>