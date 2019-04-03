function checkFields(){

	username = document.getElementById("username").value;
	password1 = document.getElementById("password").value;

	regex_Username = /^([A-Za-z0-9]){1}([A-z0-9]|[-_])*$/g
	regex_Password = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^]{8,})/g

	correctInformation = true;

	if (regex_Username.test(username)){
		document.getElementById("username").style.borderColor="black";
	} else {
		document.getElementById("username").style.borderColor="red";
		correctInformation = false;
	}

	if (regex_Password.test(password1)){
		document.getElementById("password").style.borderColor="black";
	} else {
		document.getElementById("password").style.borderColor="red";
		correctInformation = false;
	}

	return correctInformation;
}
