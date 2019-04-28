//runs all checks at submit 
 function checkFields() {

	if (checkPassword()) {
		if (checkPhone()) {
			if (checkEmail()) {
				if (checkZip()) {
					if (checkPasswordMatch()) {
						if (checkUsernameFree()) {
							if (checkFirstname()) {
								if (checkLastname()) {
									if (checkCity()) {
										return true;
									} else {
										alert("Invalid input. Please try again!");
										return false;
									}
								} else {
									alert("Invalid input. Please try again!");
									return false;
								}
							} else {
								alert("Invalid input. Please try again!");
								return false;
							}
						} else {
							alert("Invalid input. Please try again!");
							return false;
						}
					} else {
						alert("Invalid input. Please try again!");
						return false;
					}
				} else {
					alert("Invalid input. Please try again!");
					return false;
				}
			} else {
				alert("Invalid input. Please try again!");
				return false;
			}
		} else {
			alert("Invalid input. Please try again!");
			return false;
		}
	} else {
		alert("Invalid input. Please try again!");
		return false;
	}
}
		
//Check if password contains a lowerletter, upperletter, number and is over 8  characters long
function checkPassword() {
    var passw = document.getElementById("passw").value;
	var lowercase = new RegExp(/([a-z])/g);
	var uppercase = new RegExp(/([A-Z])/g);
	var numbers = new RegExp(/([0-9])/g);
	
    if (passw == ""){
	} else {
		if(passw.length > 8) { 
			if(lowercase.test(passw)) {
				if(uppercase.test(passw)) {
					if(numbers.test(passw)) {
						return true;
					} else {
						alert("Must contain a number!");
						return false;
					}				
				} else {
					alert("Must contain a uppercase letter!");
					return false;
				}
			} else {
				alert("Must contain a lowercase letter!");
				return false;
			}
		} else {
			alert("Must be at least 8 character!");
			return false;
		}
	}
}

//check if the two entered passwords are alike
function checkPasswordMatch() {
	var password1 = document.getElementById("passw").value;
	var password2 = document.getElementById("enterPassword").value;

	if (password2 == ""){

	} else {
		if (password1 == password2) {
			return true;
		} else {
			alert("Password does not match!");
			return false;
		}
	}
}

//check if phone number contains only numbers and a plussign, and checks the lenght of the number
function checkPhone() {
	var phone = document.getElementById("phone").value;
	var plusSign = new RegExp(/^\+/g);
	var numbers = new RegExp(/([0-9])/g);
	var letters = new RegExp(/([a-z]|[A-Z])/g);
	
	if (phone == ""){
	} else {
		if (plusSign.test(phone)) {
			if (numbers.test(phone)) {
				if (!letters.test(phone)) {
					if (phone.length < 9 || phone.length >= 31) {
						alert("Phone numbers must be between 8 and 30 digits");
						return false;
					} else {
						return true;
					}
				} else {
					alert("Phone number can only use numbers!");
					return false;
				}
			} else {
				alert("Phone number must contain numbers!");
				return false;
			}
		} else {
			alert("Phone number must start with a \"+\"");
			return false;
		}
	}
}

//checks the email format
function checkEmail() {
	var email = document.getElementById("email").value;
	var emailCheck = new RegExp(/\S+\S+\.([a-z]|[A-Z]){1,5}/g);
	
	if (email == ""){	
	} else {
		if (emailCheck.test(email)) {
			return true;
		} else {
			alert("Not at valid email!");
			return false;
		}
	}
}

//checks if zip is 4 characters long
function checkZip() {
	var zip = document.getElementById("zip").value;
	
	if (zip == ""){
	} else {
		if (zip.length === 4) {
			return true;
		} else {
			alert("Not at valid zip (four digits)");
			return false;
		}
	}
}

//Check if first name only contains upper- and lowerletters, and is more then 1 characters long
function checkFirstname() {
	var fname = document.getElementById("firstname").value;
	var fnameCheck = new RegExp(/([a-z]|[A-Z])/g);
	
    if (fname == ""){
	} else {
		if(fname.length > 1 && fnameCheck.test(fname)) { 
			return true;
		} else {
			alert("Not a name!");
			return false;
		}
	}
}

//Check if last name only contains upper- and lowerletters, and is more then 1 characters long
function checkLastname() {
	var lname = document.getElementById("lastname").value;
	var lnameCheck = new RegExp(/([a-z]|[A-Z])/g);
	
    if (lname == ""){
	} else {
		if(lname.length > 1 && lnameCheck.test(lname)) { 
			return true;
		} else {
			alert("Not a name!");
			return false;
		}
	}
}

//Check if city only contains upper- and lowerletters, and is more then 2 characters long
function checkCity() {
	var city = document.getElementById("city").value;
	var cityCheck = new RegExp(/([a-z]|[A-Z])/g);
	
    if (city == ""){
	} else {
		if(city.length > 2 && cityCheck.test(city)) { 
			return true;
		} else {
			alert("Not a city!");
			return false;
			
		}
	}
}

//Gets the modal
var modal = document.getElementById('id01');

//If the user clicks outside of the modal it closes

window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}






  
