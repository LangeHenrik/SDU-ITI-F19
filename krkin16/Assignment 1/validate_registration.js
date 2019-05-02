function validateForm() {
    var allInput = document.getElementsByTagName("input");
    var login = document.getElementById("login").value;
    var password = document.getElementById("password").value;
    var passwordConfirm = document.getElementById("password_confirm").value;
    var firstName = document.getElementById("first_name").value;
    var lastName = document.getElementById("last_name").value;
    var zip = document.getElementById("zip").value;
    var city = document.getElementById("city").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    
    var validData = true;
    
    for(var i = 0; i < allInput.length; i++) {
        if (!validateCommonInput(allInput[i].value)) {
            alert("Do not try to inject!");
            return false;
        }
    }
    
    if(!validateUsername(login)) {
        alert("Please don't use any symbols other than text and numbers.");
        return false;
    }
    
    if(!validateEmail(email)) {
        alert("Please enter a valid email");
        return false;
    }
    
    //console.log(validatePassword(password, passwordConfirm));
    
    
    return true;
}

function validatePassword(password, passwordRepeated) {
    return password==passwordRepeated;
}

function validateCommonInput(data) {
    return data.match(/[\t\r\n]|(--[^\r\n]*)|(\/\*[\w\W]*?(?=\*)\*\/)/gi) == null;
}

function validateUsername(data) {
    return data.match(/^[a-zA-Z0-9]+$/);
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}