function checkFields(){

	regex_Username = /^([A-Za-z0-9]){1}([A-z0-9]|[-_]){0,19}$/g
	regex_Password = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^]{8,})/g
	regex_Name = /^[A-Z]([a-z]{0,99})$/g
	regex_Name_last = /^[A-Z]([a-z]{0,99})$/g
	regex_Email = /^([A-z]+[.]?[A-z]+)+@([A-z]+[.]?[A-z]+)+[.][a-z]{2,5}$/g
	regex_Phone = /^[+][0-9]{8,30}$/g
	regex_Zip = /^[0-9]{4}$/g
	regex_City = /^(?=.[a-zA-Z ]{1,99}$)(^([A-Z]([a-z]*)+\s?)+$)/g
	
	correctInformation = true;
	
	password1 = document.getElementById("password").value; 
	password2 = document.getElementById("password_repeat").value;
	email = document.getElementById("email").value;
	username = document.getElementById("username").value;
	first_name = document.getElementById("first_name").value;
	last_name = document.getElementById("last_name").value;
	city = document.getElementById("city").value;
	zip = document.getElementById("zip").value;
	phone = document.getElementById("phone").value;

	
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
	
	if (password1 === password2){
		document.getElementById("password_repeat").style.borderColor="black";
	} else {
		document.getElementById("password_repeat").style.borderColor="red";
		correctInformation = false;
	}
	
	if (regex_Email.test(email)){
		document.getElementById("email").style.borderColor="black";
	} else {
		document.getElementById("email").style.borderColor="red";
		correctInformation = false;
	}
	
	if (regex_Name.test(first_name)){
		document.getElementById("first_name").style.borderColor="black";
	} else {
		document.getElementById("first_name").style.borderColor="red";
		correctInformation = false;
	}

	if (regex_Name_last.test(last_name)){
		document.getElementById("last_name").style.borderColor="black";
	} else {
		document.getElementById("last_name").style.borderColor="red";
		correctInformation = false;
	}
	
	if (regex_City.test(city)){
		document.getElementById("city").style.borderColor="black";
	} else {
		document.getElementById("city").style.borderColor="red";
		correctInformation = false;
	}
	
	if (regex_Zip.test(zip)){
		document.getElementById("zip").style.borderColor="black";
	} else {
		document.getElementById("zip").style.borderColor="red";
		correctInformation = false;
	}
	
	if (regex_Phone.test(phone)){
		document.getElementById("phone").style.borderColor="black";
	} else {
		document.getElementById("phone").style.borderColor="red";
		correctInformation = false;
	}
	
	return correctInformation;
}