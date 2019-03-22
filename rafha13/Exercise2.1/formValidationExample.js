function checkFields() { 
	checkName();
	checkPassword();
	checkPhone();
	checkEmail();
	checkZip();
}
		
function checkName() {
	var name = document.getElementById("name").value;	
	var nameCheck = new RegExp(/(\w+\s+)/g);
	if (nameCheck.test(name)) {
		return true;
	} else {
		alert("Name must consist of at least two words, separated by whitespace!");
		return falsse;
	}
}

function checkPassword() {
    var password = document.getElementById("password").value;
    if(password.length < 8) { 
        alert("Password must be at least 8 characters!"); 
        return false; 
    } else { 
        var smallLetters = new RegExp(/[a-z]/g);
		if (smallLetters.test(password)) {
			var bigLetters = new RegExp(/[A-Z]/g);
			if (bigLetters.test(password)) {
				var numbers = new RegExp(/[0-9]/g);
				if (numbers.test(password)) {
					return true;
				} else {
					alert("Password must contain at least one number (0-9)!");
					return false;
				}
			} else {
				alert("Password must contain at least one big letter (A-Z)!");
				return false;
			}
		} else {
			alert("Password must contain at least one small letter (a-z)!");
			return false;
		}
    } 
}

function checkPhone() {
	var phone = document.getElementById("phone").value;
	var plusSign = new RegExp(/^\+/g);
	if (plusSign.test(phone)) {
		if (phone.length < 9 || phone.length >= 31) {
			alert("Phone numbers must be between 8 and 30 digits");
			return false;
		} else {
			return true;
		}
	} else {
		alert("Phone number must start with a \"+\"");
		return false;
	}
}

function checkEmail() {
	var email = document.getElementById("email").value;
	var emailCheck = new RegExp(/\S+\S+\.([a-z]|[A-Z]){1,5}/g);
	if (emailCheck.test(email)) {
		return true;
	} else {
		alert("Email is not on proper form!");
		return false;
	}
}

function checkZip() {
	var zip = document.getElementById("zip").value;
	if (zip.length === 4) {
		return true;
	} else {
		alert("Zip must be EXCATELY four digits!");
		return false;
	}
}