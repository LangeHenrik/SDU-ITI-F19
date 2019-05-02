	function validateForm(uname, pw) {
	var noInjection = /[a-zA-Z\d]/;
	var loginUsername = /^[a-zA-Z\d]{5,16]}$/;
	var loginPw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/;
		if(noInjection.test(uname) === true) {
			if(noInjection.test(pw) === true) {
				return true;
			} else {
				alert("No special characters allowed in either username or password");
				return false;
			}
		} else {
			alert("No special characters allowed in either username or password");
			return false;
		}
			
	};
	function validateRegUser() {
		// all the regexes
		var unameRegex = /^[a-zA-Z\d]{5,16}$/;
		var pwRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/;
		var fnameRegex = /^[a-zA-Z]{2,30}$/;
		var lnameRegex = /^[a-zA-Z]{2,30}$/;
		var zipRegex = /^[\d]{4}$/;
		var cityRegex = /^[a-zA-Z]{5,30}$/;
		var emailRegex = /^[a-zA-Z\d]{1,30}@[a-zA-Z\d]{1,30}\.[a-zA-Z\d]{1,10}$/;
		var phoneRegex = /^[\d]{8}$/;
		var spanString = "";
		if(!unameRegex.test(document.getElementById("username").value)) {
			spanString+="Username must be between 5 and 16 characters. ";
		}
		if(!pwRegex.test(document.getElementById("password").value)) {
			spanString+="Password must be between 8 and 20 characters, and must contain one uppercase character, one lowercase character, and one number. "
		}
		if(!(document.getElementById("password").value === document.getElementById("repeatPassword").value)) {
			spanString+="The passwords must match. ";
		}
		if(!fnameRegex.test(document.getElementById("firstname").value)) {
			spanString+= "First name must be between 2 and 30 characters, and may only contain letters. ";
		}
		if(!lnameRegex.test(document.getElementById("lastname").value)) {
			spanString+= "Last name must be between 2 and 30 characters, and may only contain letters. ";
		}
		if(!zipRegex.test(document.getElementById("zip").value)) {
			spanString+= "Zip code must be 4 digits long. ";
		}
		if(!cityRegex.test(document.getElementById("city").value)) {
			spanString+= "City must be between 5 and 30 characters, and may only contain letters. ";
		}
		if(!emailRegex.test(document.getElementById("email").value)) {
			spanString+= "Email must be ok. ";
		}
		if(!phoneRegex.test(document.getElementById("phone").value)) {
			spanString+= "Phone number must be 8 digits long";
		}
		document.getElementById("spanid").textContent = spanString;
		if(!(spanString === "")) {
			return false;
		} else {
			return true;
		}
	};

