<?php include '../app/views/partials/header.php'; ?>
<?php include '../app/views/partials/nav.php'; ?>

<div class="after_nav">
    <h1>Indtast Brugernavn og password for at logge ind!</h1>
    </div>

<div class="row col100">
  <div>
  <form method="POST">
    <label>Username</label>
    <input type="text" name="userNameLogin" placeholder="Brugernavn">
    <label>Password</label>
    <input type="password" name="passwordLogin" placeholder="Password">
    <button class="form-submit-button" type="submit" value="Submit">Submit</button>
    <span><?php echo''.$_SESSION['globalLoginMsg'];
              $_SESSION['globalLoginMsg'] = ' ';?></span>
  </form>
  </div>
</div>

<div class="after_nav">
    <h1>Indtast dine oplysninger for at registere dig.</h1>
    </div>

<div class="row col100">
  <div>
  <form class="form-register" onsubmit="return checkFields()" method="post">

    <div id ="errorDiv" class="registerErrorDiv">
                <?php echo''.$_SESSION['globalRegisterMsg'];
                $_SESSION['globalRegisterMsg'] = ' ';?>
              </div>

              <br>

            <fieldset class="fieldset-register">
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

              <label for="frontName" style="color: black">First name</label>
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

              <input type="submit" value="Register" name="submit" class="form-submit-button">
            </fieldset>
          </form>
  </div>
</div>

</body> 

  <script src= "js/check.js"></script>
</html>