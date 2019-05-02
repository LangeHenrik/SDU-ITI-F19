<div class="mainDiv">
  <div class="registerDiv">
    <div class="registerCheckDiv">
      <form class="form-register" onsubmit="return checkFields()" method="post" action="home/register">
          <h1>Register user</h1>
          <label for="userName">User name</label><br>
          <input type="text" name="userName" id="userName" onkeyup="checkFields()" ><br>
          <label for="password">Password</label><br>
          <input type="password" name="password" id="password" onkeyup="checkFields()" ><br>
          <label for="secondPassword">Reenter password</label><br>
          <input type="password" name="secondPassword" id="secondPassword" onkeyup="checkFields()" ><br>
          <label for="firstName">First name</label><br>
          <input type="text" name="firstName" id="firstName" onkeyup="checkFields()" ><br>
          <label for="lastName">Last name</label><br>
          <input type="text" name="lastName" id="lastName" onkeyup="checkFields()" ><br>
          <label for="zip">Zip code</label><br>
          <input type="text" name="zip" id="zip" onkeyup="checkFields()" ><br>
          <label for="city">City</label><br>
          <input type="text" name="city" id="city" onkeyup="checkFields()" ><br>
          <label for="phone">Phone number</label><br>
          <input type="text" name="phone" id="phone" onkeyup="checkFields()" ><br>
          <label for="email">Email adress</label><br>
          <input type="text" name="email" id="email" onkeyup="checkFields()" ><br>
          <input type="submit" value="Register" name="submit" class="mainButton"><br>
      </form>
    </div>
  </div>

  <div class="loginDiv">
    <form class="form-login" method="post" action="home/login">
        <h1>Login</h1>
        <label for="userName">User name</label><br>
        <input type="text" name="userNameLogin" id="userNameLogin"><br>
        <label for="password">Password</label><br>
        <input type="password" name="passwordLogin" id ="passwordLogin"><br>
        <input type="submit" value="Login" class="mainButton"><br>
    </form>
  </div>
</div>
