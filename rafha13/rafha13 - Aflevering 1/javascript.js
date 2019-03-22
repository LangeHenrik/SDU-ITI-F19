function checkFields() { 
	if (
	checkUsername() &&
	checkPassword() && 
	checkSecondPassword() &&
	checkFirstname() &&
	checkLastname() &&
	checkZip() &&
	checkCity() &&
	checkEmail() &&
	checkPhone()) {
		alert("You have succesfully created a user, please log in!");
		return true;
	} else {
		alert("Some data is missing or not in right format");
		return false;
	}
}

//Username mindst 8, uden mellemrum!		
function checkUsername() {
	var userName = document.getElementById("newUsername").value;	
	var nameCheck = new RegExp(/([a-z])|([A-Z])|([0-9])/g);
	
	if ((userName == "")||(userName == null)) {
		// Nothing
	} else {
		
		
		if (nameCheck.test(userName)) {
			return true;
		} else {
			alert("Username can contain letters from a-z (big and small, and numbers 0-9");
			setTimeout(function() { document.getElementById("newUsername").focus(); }, 1);
			return false;
		}
	}
}

function checkPassword() {
    var password = document.getElementById("newPassword").value;
	
	if ((password == "")||(password == null)) {
		// Nothing
	} else {
		
		
		if(password.length < 8) { 
			alert("Password must be at least 8 characters!"); 
			setTimeout(function() { document.getElementById("newPassword").focus(); }, 1);
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
						setTimeout(function() { document.getElementById("newPassword").focus(); }, 1);
						return false;
					}
				} else {
					alert("Password must contain at least one big letter (A-Z)!");
					setTimeout(function() { document.getElementById("newPassword").focus(); }, 1);
					return false;
				}
			} else {
				alert("Password must contain at least one small letter (a-z)!");
				setTimeout(function() { document.getElementById("newPassword").focus(); }, 1);
				return false;
			}
		} 
	}
}

function checkSecondPassword() {
	var password1 = document.getElementById("newPassword").value;
	var password2 = document.getElementById("newConfirmPassword").value;
	
	if (((password1 == "")||(password1 == null)) || ((password2 == "")||(password2 == null))) {
		// Nothing
	} else {
	
	
		if (password1 == password2) {
			return true;
		} else {
			alert("Passwords do not match..!");
			setTimeout(function() { document.getElementById("newConfirmPasswordPassword").focus(); }, 1);
			return false;
		}
	}
}

// VIRKER IKKE DA DEN KAN INDEHOLDE TAL!!!
function checkFirstname() {
	var firstName = document.getElementById("newFirstname").value;
	var nameCheck = new RegExp(/([a-z]|[A-Z])/g);
	
	if ((firstName == "")||(firstName == null)) {
		// Nothing
	} else {

	
		if (nameCheck.test(firstName)) {
			return true;
		} else {
			alert("Both firstname and lastname can only contain letters! [a..z]");
			setTimeout(function() { document.getElementById("newFirstname").focus(); }, 1);
			return false;
		}
	}
}

function checkLastname() {
	var lastName = document.getElementById("newLastname").value;
	var nameCheck = new RegExp(/([a-z]|[A-Z])+/g);
	
	if ((lastName == "")||(lastName == null)) {
		// Nothing
	} else {
		
		
		if (nameCheck.test(lastName)) {
			return true;
		} else {
			alert("Both firstname and lastname can only contain letters! [a..z]");
			setTimeout(function() { document.getElementById("newLastname").focus(); }, 1);
			return false;
		}
	}
}

function checkZip() {
	var zip = document.getElementById("newZip").value;
	
	if ((zip == "")||(zip == null)) {
		// Nothing
	} else {
		
		
		if (zip.length === 4) {
			return true;
		} else {
			alert("Zip must be EXCATELY four digits!");
			setTimeout(function() { document.getElementById("newZip").focus(); }, 1);
			return false;
		}
	}
}


// Fungere også med tal...
function checkCity() {
	var city = document.getElementById("newCity").value;
	var nameCheck = new RegExp(([a-z]|[A-Z])/g);
	
	if ((city == "")||(city == null)) {
		// Nothing
	} else {
		
			
		if (nameCheck.test(city)) {
			return true;
		} else {
			alert("City name can only contain letters! [a..z]");
			setTimeout(function() { document.getElementById("newCity").focus(); }, 1);
			return false;
		}
	}
}

function checkEmail() {
	var email = document.getElementById("newEmail").value;
	var emailCheck = new RegExp(/\S+\S+\.([a-z]|[A-Z]){1,5}/g);
	
	if ((email == "")||(email == null)) {
		// Nothing
	} else {
		
		
		if (emailCheck.test(email)) {
			return true;
		} else {
			alert("Email is not on proper form!");
			setTimeout(function() { document.getElementById("newEmail").focus(); }, 1);
			return false;
		}
	}
}

function checkPhone() {
	var phone = document.getElementById("newPhone").value;
	var plusSign = new RegExp(/^\+/g);
	
	if ((phone == "")||(phone == null)) {
		// Nothing
	} else {
		
		
		if (plusSign.test(phone)) {
			if (phone.length < 9 || phone.length >= 31) {
				alert("Phone numbers must be between 8 and 30 digits");
				setTimeout(function() { document.getElementById("newPhone").focus(); }, 1);
				return false;
			} else {
				return true;
			}
		} else {
			alert("Phone number must start with a \"+\"");
			setTimeout(function() { document.getElementById("newPhone").focus(); }, 1);
			return false;
		}
	}
}