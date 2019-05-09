function checkFields() {
  var username = document.getElementById("username").value;
  var validUserName = /^[0-9a-zA-Z]+$/.test(userName);

  var password = document.getElementById("password").value;
  var validPassword = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/.test(password);

  var secondPassword = document.getElementById("secondPassword").value;



  if (!(validUsername && username.length >= 1 && username.length <= 20)) {
    console.log("Not valid username");
    document.getElementById("errorDiv").innerHTML = "Username must only consist of letters (big or small), numbers and be less than 20 chars."
    return false;
  }

  if (!(password.length >= 8 && password.length <= 30 && validPassword)) {
    console.log("Your password must be atleast 8 characters long, have an upper case"
    + ", a lower case and a number");
    document.getElementById("errorDiv").innerHTML = "Password must be atleast 8 characters long, less than 30, have an upper case"
    + ", a lower case and a number."
    return false;
  }

  if (password != secondPassword) {
    console.log("Your repeated password is not the same as the first.");
    document.getElementById("errorDiv").innerHTML = "Your repeated password is not the same as the first."
    return false;
  }

  

  document.getElementById("errorDiv").innerHTML = "All inputs are valid, you can now login if you press register.";
  return true;
}