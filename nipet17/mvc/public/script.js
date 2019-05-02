function isValidForm() {
  var name        = document.getElementById("name").value;
  var email       = document.getElementById("email").value;
  var password    = document.getElementById("password").value;
  var username    = document.getElementById("username").value;
  var verify      = document.getElementById("password2").value;
  var phone       = document.getElementById("phone").value;
  var zip         = document.getElementById("zip").value;
  var city        = document.getElementById("city").value;

  if (name.trim() == "" || email.trim() == "" || password.trim() == "" ||
        veriify.trim() == "" || username.trim() == "" || phone.trim() == "" ||
          zip.trim() == "" || city.trim() == "") {

    var validation  = false;
  } else {
    var validation  = true;
    //Check if name is entered correct
    if ((/^\w+\s+\w+$/g).test(name)){
        document.getElementById("ename").style.opacity = 0;
    } else {
        document.getElementById("ename").style.opacity = 1;
        validation  = false;
    }

    // Email checks
    if ((/^\S+@\S+\.([a-z]|[A-Z]){1,5}$/g).test(email)) {
        document.getElementById("eemail").style.opacity = 0;
    } else {
        document.getElementById("eemail").style.opacity = 1;
        validation  = false;
    }

    // Password checks
    if((/^[a-zA-Z0-9!@#$%^&*]{8,}$/g).test(password)){
        document.getElementById("epassword").style.opacity = 0;
    } else {
        document.getElementById("epassword").style.opacity = 1;
        validation  = false;
    }

    // PasswordVerify checks
    if (verify.length === password.length) {
      document.getElementById("epassword2").style.opacity = 0;
    } else {
      document.getElementById("epassword2").style.opacity = 1;
      validation  = false;
    }

    // Username checks
    if ((/^\w+$/g).test(username)){
        document.getElementById("euser").style.opacity = 0;
    } else {
        document.getElementById("euser").style.opacity = 1;
        validation  = false;
    }

    // Phone check
    if ((/^[0-9]{8,30}$/g).test(phone)) {
        document.getElementById("ephone").style.opacity = 0;
    } else {
        document.getElementById("ephone").style.opacity = 1;
        validation  = false;
    }

    // Zip check
    if ((/^\d{4}/g).test(zip)) {
        document.getElementById("ezip").style.opacity = 0;
    } else {
        document.getElementById("ezip").style.opacity = 1;
        validation  = false;
    }

    // City check
    if ((/^([A-Z]|[a-z])\w+$/g).test(city)) {
        document.getElementById("ecity").style.opacity = 0;
    } else {
        document.getElementById("ecity").style.opacity = 1;
        validation  = false;
    }
  }
  if (validation) {
    return true;
  } else {
    return false;
  }
}
