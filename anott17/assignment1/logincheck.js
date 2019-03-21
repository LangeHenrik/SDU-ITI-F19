function checkFields() {
  var userName = document.getElementById("userName").value;
  var validUserName = /^[0-9a-zA-Z]+$/.test(userName);

  var password = document.getElementById("password").value;
  var validPassword = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/.test(password);

  var secondPassword = document.getElementById("secondPassword").value;

  var frontName = document.getElementById("frontName").value;
  var validFrontName = /^[a-zA-Z]+$/.test(frontName);

  var lastName = document.getElementById("lastName").value;
  var validLastName = /^[a-zA-Z]+$/.test(lastName);

  var zip = document.getElementById("zip").value;
  var validZipCode = /^[0-9]+$/.test(zip);

  var city = document.getElementById("city").value;
  var validCity = /^[a-zA-Z]+$/.test(city);

  var phone = document.getElementById("phone").value;
  var validPhoneNr = /^\+[0-9]{8,30}/.test(phone);

  var mail = document.getElementById("email").value;
  var validMail = /\S+@\S+\.([a-z]|[A-Z]){1,5}/.test(mail);

  if (!(validUserName && userName.length >= 1 && userName.length <= 20)) {
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

  if (!(validFrontName && frontName.length >= 1 && frontName.length <= 30)) {
    console.log("Your front name name must only be in letters.");
    document.getElementById("errorDiv").innerHTML = "Your front name name must only be in letters and be less than 30 characters.";
    return false;
  }

  if (!(validLastName && lastName.length >= 1 && lastName.length <= 30)) {
    console.log("Your last name must only be in letters.");
    document.getElementById("errorDiv").innerHTML = "Your lastname name must only be in letters and be less than 30 characters.";
    return false;
  }

  if(!(validZipCode && zip.length == 4)) {
    console.log("Your zip code must be digits and exactly 4 long.");
    document.getElementById("errorDiv").innerHTML = "Your zip code must be 4 digits long.";
    return false;
  }

  if (!(validCity && city.length >= 1 && city.length <= 30)) {
    console.log("Your city name must only be in letters and be less than 30 characters long.");
    document.getElementById("errorDiv").innerHTML = "Your city name must only be in letters and be less than 30 characters long.";
    return false;
  }

  if (!(validPhoneNr)) {
    console.log("Your phonenumber must be between 8 and 30 digits and start with +.");
    document.getElementById("errorDiv").innerHTML = "Your phonenumber must be between 8 and 30 digits and start with +.";
    return false;
  }

  if (!(validMail)) {
    console.log("Please write an correct mail.")
    document.getElementById("errorDiv").innerHTML = "Please write a valid mail.";
    return false;
  }

  document.getElementById("errorDiv").innerHTML = "All inputs are valid, you can now login if you press register.";
  return true;
}
