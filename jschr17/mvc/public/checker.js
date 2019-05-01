let attempts = 3;

function loginCheck(){
    if (attempts <= 0 ){
        document.getElementById("username").disabled = true;
        document.getElementById("password").disabled = true;
        document.getElementById("submit").disabled = true;
        return false;
    } else {
        let password = document.getElementById("password").value;
        let name = document.getElementById("username");
        attempts -= 1;
        if (password != null && name != null) {
            // if (usernameCheck() && passFormatCheck()){
            //     alert("login successful")
            //     document.location.href = "";
            //     return true;
            // }
            return true
        } else {
            document.location.href = "";
            document.getElementById('loginlabel').innerHTML = 'Error logging in. You have to enter a username and a password';
            return false;
        }
    }
}

function register(){
    if (usernameCheck() && passwordCheck()){
        return true;
    }
}

//function to check if username follows format
function usernameCheck(){
    let name = document.getElementById("username");
    if (name.length < 2){
        alert("username is not long enough");
        return false;
    } else {
        return true;
    }
}

//function to check if password follows the format
function passFormatCheck(){
    let password = document.getElementById("password").value;
    if (password.length < 8) {
        document.getElementById("passeval").innerText = "Password must be at least 8 characters";
        return false;
    } else if (!/[A-Z]/.test(password)) {
        document.getElementById("passeval").innerText = "Password must contain at least one upper case character";
        return false;
    } else if (!(/[a-z]/).test(password)) {
        document.getElementById("passeval").innerText = "Password must contain at least one lower case character";
        return false
    } else {
        return true;
    }
}

//function to check passwords are the same and follow format for registration
function passwordCheck(){
    let password = document.getElementById("password").value;
    let password2 = document.getElementById("password2").value;
    if (password == password2) {
        return passFormatCheck();
    } else {
        alert("Passwords do not match");
        return false;
    }
}

// function to check email against regex: re
function emailCheck(){
    let email = document.getElementById("email").value;
    let re = /\S+@\S+\.\S+/;
    if (re.test(String(email).toLowerCase())) {
        document.getElementById("emailval").innerText = " ";
        return true;
    } else {
        document.getElementById("emailval").innerText = "The e-mail can't be... that.";
        return false;
    }
}
