<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel ="stylesheet" type="text/css" href="style.css">
    <script src= "logincheck.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anott17</title>
  </head>
  <body>
    <div class="mainDiv">
      <h1>Welcome to Photos</h1>
      <div class="registerDiv">
        <div class="registerCheckDiv">
          <form class="form-register" onsubmit="return checkFields()" method="post">
            <fieldset class="fieldset-register">
              <legend>Register</legend>
              <label for="userName" style="color: black">User name</label>
              <br>
              <input type="text" name="userName" id="userName" onkeyup="checkFields()" >
              <br>

              <label for="password">Password</label>
              <br>
              <input type="password" name="password" id="password" onkeyup="checkFields()" >
              <br>

              <label for="secondPassword">Reenter password</label>
              <br>
              <input type="password" name="secondPassword" id="secondPassword" onkeyup="checkFields()" >
              <br>

              <label for="frontName" style="color: black">Front name</label>
              <br>
              <input type="text" name="frontName" id="frontName" onkeyup="checkFields()" >
              <br>

              <label for="lastName" style="color: black">Last name</label>
              <br>
              <input type="text" name="lastName" id="lastName" onkeyup="checkFields()" >
              <br>

              <label for="zip">Zip code</label>
              <br>
              <input type="text" name="zip" id="zip" onkeyup="checkFields()" >
              <br>

              <label for="city">City</label>
              <br>
              <input type="text" name="city" id="city" onkeyup="checkFields()" >
              <br>

              <label for="phone">Phone number</label>
              <br>
              <input type="text" name="phone" id="phone" onkeyup="checkFields()" >
              <br>

              <label for="email">Email adress</label>
              <br>
              <input type="text" name="email" id="email" onkeyup="checkFields()" >
              <br>

              <input type="submit" value="Register" name="submit" id="submit">

              <div id ="errorDiv" class="registerErrorDiv">
                <p></p>

              </div>
            </fieldset>
          </form>
        </div>
      </div>

      <div class="loginDiv">
        <form class="form-login" method="post">
          <fieldset class="fieldset-login">
            <legend>Login</legend>
            <label for="userName" style="color: black">User name</label>
            <br>
            <input type="text" name="userName" id="userName">
            <br>

            <label for="password" style="color: black">Password</label>
            <br>
            <input type="password" name="password" id ="password">
            <br>

            <input type="submit" value="Login">
          </fieldset>
        </form>
      </div>
    </div>
  </body>
</html>
