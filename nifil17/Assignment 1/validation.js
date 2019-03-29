function validateForm(uname, pw) {
	var noInjection = /[a-zA-Z\d]/;
	var loginUsername = /^[a-zA-Z\d]{5,16]}$/;
	var loginPw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/;
	if(noInjection.test(uname) === true) {
		if(noInjection.test(pw) === true) {
			return true;
		} else {
			alert("No special characters allowed in username or password");
			return false;
		}
	} else {
		alert("No special characters allowed in username or password");
		return false;
	}
};

function validateRegUser(uname, pw, rpw, fname, lname, zip, city, email, phone) {
		var unameRegex = /^[a-zA-Z\d]{5,16}$/;
		var pwRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/;
		var fnameRegex = /^[a-zA-Z]{2,30}$/;
		var lnameRegex = /^[a-zA-Z]{2,30}$/;
		var zipRegex = /^[\d]{4}$/;
		var cityRegex = /^[a-zA-Z]{5,30}$/;
		var emailRegex = /^[a-zA-Z\d]{1,30}@[a-zA-Z\d]{1,30}\.[a-zA-Z\d]{1,10}$/;
		var phoneRegex = /^[\d]{8}$/;
		var regexArray = [unameRegex,pwRegex,fnameRegex,lnameRegex,zipRegex,cityRegex,emailRegex,phoneRegex];
		var inputArray = [uname, pw,fname,lname,zip,city,email,phone];
		// Validation
		if(pw === rpw) {
			for(i = 0; i < inputArray.length; i++) {
			if(regexArray[i].test(inputArray[i]) === false) {
				alert("Input field " + i+1 + " was wrong. Mouse over to see requirements");
				return false;
			}
			return true;
		}
		} else {
			alert("Passwords must match");
			return false;
		}
	};

