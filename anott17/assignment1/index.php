<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel ="stylesheet" type="text/css" href="style.css">
    <script src= "logincheck.js"></script>
    <title>Anott17</title>
  </head>
  <body>
    <div class="classA">
      <h1>Welcome to blabla</h1>
      <div class="classB">
        <form class="form-register" onsubmit="checkFields()" method="post">
          <label for="userName" style="color: black">User name</label>
          <br>
          <input type="text" name="userName" id="userName">
          <br>

          <label for="password">Password</label>
          <br>
          <input type="password" name="password" id="password">
          <br>

          <label for="secondPassword">Reenter password</label>
          <br>
          <input type="password" name="secondPassword" id="secondPassword">
          <br>

          <label for="frontName" style="color: black">Front name</label>
          <br>
          <input type="text" name="frontName" id="frontName">
          <br>

          <label for="lastName" style="color: black">Last name</label>
          <br>
          <input type="text" name="lastName" id="lastName">
          <br>

          <label for="zip">Zip code</label>
          <br>
          <input type="text" name="zip" id="zip">
          <br>

          <label for="city">City</label>
          <br>
          <input type="text" name="city" id="city">
          <br>

          <label for="phone">Phone number</label>
          <br>
          <input type="text" name="phone" id="phone">
          <br>

          <label for="email">Email adress</label>
          <br>
          <input type="text" name="email" id="email">
          <br>

          <input type="submit" name="submit" id="submit">
        </form>
      </div>
      <div class="classC">

      </div>
    </div>
  </body>
</html>
