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
        if (password != 'null' && name != "null") {
            alert("login successful")
            document.location.href = "user_page.html";
            return true;
        } else {
            document.location.href = "login_page.html";
            document.getElementById('loginlabel').innerHTML = 'Error logging in.';
            return false;
        }
    }
}

function register(){
    if (usernameCheck() && passwordCheck()){
        return true;
    }
}


function usernameCheck(){
    let name = document.getElementById("username");
    if (name.length < 2){
        alert("username is not long enough");
        return false;
    } else {
        return true;
    }
}

function passwordCheck(){
    let password = document.getElementById("password").value;
    let password2 = document.getElementById("password2").value;
    if (password == password2) {
        if (password.length < 8) {
            alert("Password must be at least 8 characters");
            return false;
        } else if (!/[A-Z]/.test(password)) {
            alert("password must contain at least one upper case character");
            return false;
        } else if (!(/[a-z]/).test(password)) {
            alert("password must contain at least one lower case character");
            return false
        } else {
            return true;
        }
    } else {
        alert("Passwords do not match");
        return false;
    }
}

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
