<?php include '../app/views/partials/head.php'; ?>

<div class="mainDiv">
  <h1>Nifra17's webpage</h1>
  <div class="registerDiv">
    <div class="registerCheckDiv">
      <form class="form-register" onsubmit="return checkFields()" method="post" action="home/register">
        <fieldset class="fieldset-register">
          <legend>Register</legend>
          <label for="username" style="color: black">Username</label>
          <br>
          <input type="text" name="username" id="username" onkeyup="checkFields()" >
          <br>

          <label for="password">Password</label>
          <br>
          <input type="password" name="password" id="password" onkeyup="checkFields()" >
          <br>

          <label for="secondPassword">Reenter password</label>
          <br>
          <input type="password" name="secondPassword" id="secondPassword" onkeyup="checkFields()" >
          <br>

          
          <input type="submit" value="Register" name="submit" class="mainButton">

         
            <p></p>
      
        </fieldset>
      </form>
    </div>
  </div>

  <div class="loginDiv">
    <form class="form-login" method="post" action="home/login">
      <fieldset class="fieldset-login">
        <legend>Login</legend>
        <label for="username" style="color: black">Username</label>
        <br>
        <input type="text" name="username" id="username">
        <br>

        <label for="password" style="color: black">Password</label>
        <br>
        <input type="password" name="password" id ="password">
        <br>

        <input type="submit" value="Login" class="mainButton">
     
      </fieldset>
    </form>
  </div>
</div>