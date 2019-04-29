function checkFields() {
  var name = document.getElementById("name").value;
  var password = document.getElementById("password").value;
  var phone = document.getElementById("phone").value;
  var email = document.getElementById("email").value;
  var zip = document.getElementById("zip").value;

  let regexName = /[^a-zA-Z0-9 ]/g;
  let regexPw = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
  let regexPhone = new RegExp("^[+][0-9]{8,30}$");
  let regexEmail = new RegExp("[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z]{2,4}");
  let regexZIP = new RegExp("^[0-9]{4}$");

  //name validation
  if (name < 1) {
    alert("Full Name must be entered");
    return false;
  } else if (regexName.test(name)) {
    alert("Full Name must be seperated by space, no special characters");
    return false;
  }

  if (password < 1) {
    //password validation
    alert("Please enter a password");
    return false;
  } else if (!regexPw.test(password)) {
    alert(
      "Password must contain atleast 8 characters, including 1 Uppercase\n, Lowercase and digit"
    );
    return false;
  }
  if (phone < 1) {
    //phoneNo validation
    alert("Please enter your phone number");
    return false;
  } else if (!regexPhone.test(phone)) {
    alert(
      "Phone number must start with [+] and contain a minimum of \n 8 digits and maximum 30 digits "
    );
    return false;
  }

  if (email < 1) {
    //email validation
    alert("Please enter your email");
    return false;
  } else if (!regexEmail.test(email)) {
    alert(
      "Did you remember to add a single @ symbol and specify your mail domain?"
    );
    return false;
  }

  if (zip.value < 1) {
    //zip validation
    alert("Please enter your ZIP code");
    return false;
  } else if (!regexZIP.test(zip)) {
    alert("ZIP must contain 4 digits");
    return false;
  } else {
    return true;
  }
}

