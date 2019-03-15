function checkFields() {
  var userName = document.getElementById("userName").value;
  var validUserName = /([a-z]|[A-Z]){1,40}/.test(userName);

  var password = document.getElementById("password").value;
  var validPassword = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/.test(password);

  var secondPassword = document.getElementById("secondPassword").value;

  var frontName = document.getElementById("frontName").value;
  var validFrontName = /([a-z]|[A-Z]){1,40}/.test(frontName);

  var lastName = document.getElementById("lastName").value;
  var validLastName = /([a-z]|[A-Z]){1,40}/.test(lastName);

  var zip = document.getElementById("zip").value;
  var validZipCode = /[0-9]{4}/.test(zip);

  var city = document.getElementById("city").value;
  var validCity = /([a-z]|[A-Z]){1,40}/.test(city);

  var phone = document.getElementById("phone").value;
  var validPhoneNr = /^\+[0-9]{8,30}/.test(phone);

  var mail = document.getElementById("email").value;
  var validMail = /\S+@\S+\.([a-z]|[A-Z]){1,5}/g.test(email);

  if (!(validUserName)) {
    console.log("Not valid username");
    return false;
  }

  if (!(password.length >= 8 && validPassword)) {
    console.log("Your password must be atleast 8 characters long, have an upper case"
    + ", a lower case and a number");
    return false;
  }

  if (password != secondPassword) {
    console.log("Your repeated password is not the same as the first.");
    return false;
  }

  if (!(validFrontName)) {
    console.log("Your front name name must only be in letters.");
    return false;
  }

  if (!(validLastName)) {
    console.log("Your city name must only be in letters.")
    return false;
  }

  if(!(validZipCode)) {
    console.log("Your zip code must be digits and exactly 4 long.");
    return false;
  }

  if (!(validCity)) {
    console.log("Your city name must only be in letters.")
    return false;
  }

  if (!(validPhoneNr)) {
    console.log("Your phonenumber must be between 8 and 30 digits and start with +.");
    return false;
  }

  if (!(validMail)) {
    return false;
  }
}
