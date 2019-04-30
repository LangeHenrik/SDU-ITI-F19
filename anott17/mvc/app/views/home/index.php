<?php include '../app/views/partials/head.php'; ?>

<div class="mainDiv">
  <h1>Welcome to Anott17's website</h1>
  <div class="registerDiv">
    <div class="registerCheckDiv">
      <form class="form-register" onsubmit="return checkFields()" method="post" action="home/register">
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

          <input type="submit" value="Register" name="submit" class="mainButton">

          <div id ="errorDiv" class="registerErrorDiv">
            <p></p>
            <?php echo''.$_SESSION['globalRegisterMsg'];
            $_SESSION['globalRegisterMsg'] = ' ';?>
          </div>
        </fieldset>
      </form>
    </div>
  </div>

  <div class="loginDiv">
    <form class="form-login" method="post" action="home/login">
      <fieldset class="fieldset-login">
        <legend>Login</legend>
        <label for="userName" style="color: black">User name</label>
        <br>
        <input type="text" name="userNameLogin" id="userNameLogin">
        <br>

        <label for="password" style="color: black">Password</label>
        <br>
        <input type="password" name="passwordLogin" id ="passwordLogin">
        <br>

        <input type="submit" value="Login" class="mainButton">
        <div id ="errorDivLogin" class="loginErrorDiv">
          <?php echo''.$_SESSION['globalLoginMsg'];
          $_SESSION['globalLoginMsg'] = ' ';?>
        </div>
      </fieldset>
    </form>
  </div>
</div>
