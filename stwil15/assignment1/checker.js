let attempts = 3;

function loginCheck(){
    if (attempts <= 0 ){
        // print fuck you you forgot your password
    } else {
        let password = document.getElementById("password").value;
        let name = document.getElementById("name");
        attempts -= 1;
        if (password != 'null' && name != null) {
            alert("login successful")
            document.location.href = "user_page.html";
            return true;
        } else {
            document.getElementById('loginlabel').innerHTML = 'Error logging in.';
            return true;
        }
    }
}

function register(){
    if (usernameCheck() && passwordCheck()){
        document.location.href = "login_page.html";
        return true;
    }
}


function usernameCheck(){
    let name = document.getElementById("name");
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
