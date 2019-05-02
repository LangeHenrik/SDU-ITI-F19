var wrongCredentials = {};

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
			if(!(allInput[i].id+"_wrong" in wrongCredentials)) {
				wrongCredentials[allInput[i].id+"_wrong"] = true;
				document.getElementById(allInput[i].id+"_wrong").innerHTML = "Should at include min 4 letters or numbers and no other symbols"
			}
			console.log(allInput[i].id+"_wrong");
            validData = false;
        }
    }
    
    if(!validateUsername(login)) {
		document.getElementById("login_wrong").innerHTML = "Username: <br> Should be at least 4 letters long and unique";
        validData = false;
    }
    
    if(!validateEmail(email)) {
		document.getElementById("email_wrong").innerHTML = "Invalid mail";
        validData = false;
    }
    
    //console.log(validatePassword(password, passwordConfirm));
    
	if(validData)
		document.getElementById("registerForm").action = "/krkin16/mvc/public/login/registerUser";
}

function validatePassword(password, passwordRepeated) {
    return password==passwordRepeated;
}

function validateCommonInput(data) {
	var validated = true;
	
	if( data.match(/[\t\r\n]|(--[^\r\n]*)|(\/\*[\w\W]*?(?=\*)\*\/)/gi) != null) validated = false;
	if(data.length < 4) validated = false;
	
    return validated;
}

function validateUsername(data) {
    return data.match(/^[a-zA-Z0-9]+$/);
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}