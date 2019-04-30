function checkName(){
    var name = document.getElementById("name").value;

    if ((/^\w+\s+\w+$/g).test(name)){
        document.getElementById("lname").style.color = "green";
        return true;
    } else {
        document.getElementById("lname").style.color = "red";
        return false;
    }
}

function checkEmail() {
    var email = document.getElementById("email").value;

    if ((/^\S+@\S+\.([a-z]|[A-Z]){1,5}$/g).test(email)) {
        document.getElementById("lemail").style.color = "green";
        return true;
    } else {
        document.getElementById("lemail").style.color = "red";
        return false;
    }
}

function checkPassword() {
    var password = document.getElementById("password").value;

    if((/^[a-zA-Z0-9!@#$%^&*]{8,}$/g).test(password)){
        document.getElementById("lpassword").style.color = "green";
        return true;
    } else {
        document.getElementById("lpassword").style.color = "red";
        return false;
    }
}

function checkUsername() {
  var username = document.getElementById("name").value;

  if ((/^\w+$/g).test(username)){
      document.getElementById("luser").style.color = "green";
      return true;
  } else {
      document.getElementById("luser").style.color = "red";
      return false;
  }
}

function checkVerify() {
  var password = document.getElementById("password").value;
  var verify = document.getElementById("password2").value;

  if (verify.length === password.length) {
    document.getElementById("lpassword2").style.color = "green";
    return true;
  } else {
    document.getElementById("lpassword2").style.color = "red";
    return false;
  }
}

function checkPhone() {
    var phone = document.getElementById("phone").value;

    if ((/^[0-9]{8,30}$/g).test(phone)) {
        document.getElementById("lphone").style.color = "green";
        return true;
    } else {
        document.getElementById("lphone").style.color = "red";
        return false;

    }
}

function checkZip() {
    var zip = document.getElementById("zip").value;

    if ((/^\d{4}$/g).test(zip)) {
        document.getElementById("lzip").style.color = "green";
        return true;
    } else {
        document.getElementById("lzup").style.color = "red";
        return false;
    }

}

function checkCity() {
    var city = document.getElementById("city").value;

    if ((/^([A-Z]|[a-z])\w+$/g).test(city)) {
        document.getElementById("lzip").style.color = "green";
        return true;
    } else {
        document.getElementById("lzup").style.color = "red";
        return false;
    }

}
