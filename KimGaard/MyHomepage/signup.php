<?php
require "header.php";
?>

<main>
  <div class="space"></div>

  <!-- <div class="wrapper-main">
    <section class="section-default">
      <h1>Sigup</h1>
      <form class="form-signup" action="includes/signup.inc.php" method="post">
        <input id="uidd" class="inputfield" type="text" name="uid" placeholder="Username" oninput="tjekusern()">
        <input id="uidd" class="inputfield" type="text" name="fname" placeholder="First Name">
        <input id="uidd" class="inputfield" type="text" name="lname" placeholder="Last Name">
        <input class="inputfield" type="text" name="mail" placeholder="E-mail">
        <input id="pword" class="inputfield" type="password" name="pwd" placeholder="Password" oninput="validate()">
        <input class="inputfield" type="password" name="pwd-confirm" placeholder="Confirm password">
        <button class="button" type="submit" name="signup-submit">Signup</button>
      </form>
    </section>
  </div> -->

  <div class="wrapper-main">
    <section class="section-default">
      <h1>SIGNUP</h1>
      <form id="myForm" method="POST" action="includes/signup.inc.php">
        <input id="field_username" class="inputfield" title="Username must not be blank and contain only letters, numbers and underscores." type="text" required pattern="\w+" name="uid" placeholder="Username">
        <!-- <input class="inputfield" type="text" name="fname" placeholder="First Name">
        <input class="inputfield" type="text" name="lname" placeholder="Last Name"> -->
        <input class="inputfield" type="text" name="mail" placeholder="E-mail">
        <input id="field_pwd1" class="inputfield" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd" placeholder="Password">
        <input id="field_pwd2" class="inputfield" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd-confirm" placeholder="Confirm password">
        <button class="button" class="inputfield" type="submit" name="signup-submit">Signup</button>
      </form>
    </section>
  </div>

  <div class="space"></div>

  <!-- <script type="text/javascript">
  function tjekusern(){
    let username = document.getElementById('uidd').value;
    let regUN = /^[a-zA-Z0-9]*$/gm;
    if (!regUN.test(username)) {
      alert("only letters and numbers are allowed");
      document.getElementById('uidd').value = "";
    }
  }
  </script> -->


  <script type="text/javascript">

  document.addEventListener("DOMContentLoaded", function() {

    // JavaScript form validation

    var checkPassword = function(str)
    {
      var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
      return re.test(str);
    };

    var checkForm = function(e)
    {
      if(this.username.value == "") {
        alert("Error: Username cannot be blank!");
        this.username.focus();
        e.preventDefault(); // equivalent to return false
        return;
      }
      re = /^\w+$/;
      if(!re.test(this.username.value)) {
        alert("Error: Username must contain only letters, numbers and underscores!");
        this.username.focus();
        e.preventDefault();
        return;
      }
      if(this.pwd1.value != "" && this.pwd1.value == this.pwd2.value) {
        if(!checkPassword(this.pwd1.value)) {
          alert("The password you have entered is not valid!");
          this.pwd1.focus();
          e.preventDefault();
          return;
        }
      } else {
        alert("Error: Please check that you've entered and confirmed your password!");
        this.pwd1.focus();
        e.preventDefault();
        return;
      }
      alert("Both username and password are VALID!");
    };

    var myForm = document.getElementById("myForm");
    myForm.addEventListener("submit", checkForm, true);

    // HTML5 form validation

    var supports_input_validity = function()
    {
      var i = document.createElement("input");
      return "setCustomValidity" in i;
    }

    if(supports_input_validity()) {
      var usernameInput = document.getElementById("field_username");
      usernameInput.setCustomValidity(usernameInput.title);

      var pwd1Input = document.getElementById("field_pwd1");
      pwd1Input.setCustomValidity(pwd1Input.title);

      var pwd2Input = document.getElementById("field_pwd2");

      // input key handlers

      usernameInput.addEventListener("keyup", function(e) {
        usernameInput.setCustomValidity(this.validity.patternMismatch ? usernameInput.title : "");
      }, false);

      pwd1Input.addEventListener("keyup", function(e) {
        this.setCustomValidity(this.validity.patternMismatch ? pwd1Input.title : "");
        if(this.checkValidity()) {
          pwd2Input.pattern = RegExp.escape(this.value);
          pwd2Input.setCustomValidity(pwd2Input.title);
        } else {
          pwd2Input.pattern = this.pattern;
          pwd2Input.setCustomValidity("");
        }
      }, false);

      pwd2Input.addEventListener("keyup", function(e) {
        this.setCustomValidity(this.validity.patternMismatch ? pwd2Input.title : "");
      }, false);

    }

  }, false);

</script>

<script type="text/javascript">

// polyfill for RegExp.escape
if(!RegExp.escape) {
  RegExp.escape = function(s) {
    return String(s).replace(/[\\^$*+?.()|[\]{}]/g, '\\$&');
  };
}

</script>

</main>

<?php
require "footer.php";
?>
