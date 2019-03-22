function checkName(){
    var name = document.getElementById("name").value;

    if ((/^\w+\s+\w+$/g).test(name)){
        document.getElementById("ename").style.opacity = 0;
        return true;
    } else {
        document.getElementById("ename").style.opacity = 1;
        return false;
    }
}

function checkEmail() {
    var email = document.getElementById("email").value;

    if ((/^\S+@\S+\.([a-z]|[A-Z]){1,5}$/g).test(email)) {
        document.getElementById("eemail").style.opacity = 0;
        return true;
    } else {
        document.getElementById("eemail").style.opacity = 1;
        return false;
    }
}

function checkPassword() {
    var password = document.getElementById("password").value;

    if((/^[a-zA-Z0-9!@#$%^&*]{8,}$/g).test(password)){
        document.getElementById("epassword").style.opacity = 0;
        return true;
    } else {
        document.getElementById("epassword").style.opacity = 1;
        return false;
    }
}

function checkUsername() {
  var username = document.getElementById("username").value;

  if ((/^\w+$/g).test(username)){
      document.getElementById("euser").style.opacity = 0;
      return true;
  } else {
      document.getElementById("euser").style.opacity = 1;
      return false;
  }
}

function checkVerify() {
  var password = document.getElementById("password").value;
  var verify = document.getElementById("password2").value;

  if (verify.length === password.length) {
    document.getElementById("epassword2").style.opacity = 0;
    return true;
  } else {
    document.getElementById("epassword2").style.opacity = 1;
    return false;
  }
}

function checkPhone() {
    var phone = document.getElementById("phone").value;

    if ((/^[0-9]{8,30}$/g).test(phone)) {
        document.getElementById("ephone").style.opacity = 0;
        return true;
    } else {
        document.getElementById("ephone").style.opacity = 1;
        return false;

    }
}

function checkZip() {
    var zip = document.getElementById("zip").value;

    if ((/^\d{4}/g).test(zip)) {
        document.getElementById("ezip").style.opacity = 0;
        return true;
    } else {
        document.getElementById("ezip").style.opacity = 1;
        return false;
    }

}

function checkCity() {
    var city = document.getElementById("city").value;

    if ((/^([A-Z]|[a-z])\w+$/g).test(city)) {
        document.getElementById("ecity").style.opacity = 0;
        return true;
    } else {
        document.getElementById("ecity").style.opacity = 1;
        return false;
    }

}
