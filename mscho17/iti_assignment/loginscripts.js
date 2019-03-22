function checkLogin(){
	let sucess = true;
	username = document.getElementById("login_username");
	userPassword = document.getElementById("login_userPassword");
	if(!checkUsername(username.value)){
		username.style.backgroundColor = "red";
		sucess = false;
		
	} else {
		username.style.backgroundColor = "";
	}
	if(!checkuserPassword(userPassword.value)){
		userPassword.style.backgroundColor = "red";
		sucess = false;
	} else {
		userPassword.style.backgroundColor = "";
	}

	return sucess;
}

function checkRegister(){
	let sucess = true;
	username = document.getElementById("register_username");
	userPassword = document.getElementById("register_userPassword");
	repeatuserPassword = document.getElementById("repeatuserPassword");
	email = document.getElementById("email");
	zipCode = document.getElementById("zipCode");
	city = document.getElementById("city");
	firstName = document.getElementById("firstName");
	lastName = document.getElementById("lastName");
	phoneNumber = document.getElementById("phoneNumber");
	
	if(!checkUsername(username.value)){
		username.style.backgroundColor = "red";
		sucess = false;
		
	} else {
		username.style.backgroundColor = "";
	}
	
	if(!checkuserPassword(userPassword.value)){
		userPassword.style.backgroundColor = "red";
		sucess = false;
	} else {
		userPassword.style.backgroundColor = "";
	}
	if(!userPassword.value == repeatuserPassword.value){
		repeatuserPassword.style.backgroundColor = "red";
		sucess = false;
	} else {
		repeatuserPassword.style.backgroundColor = "";
	}
	if(!checkName(firstName.value)){
		firstName.style.backgroundColor = "red";
		sucess = false;
	} else {
		firstName.style.backgroundColor = "";
	}
	
	if(!checkName(lastName.value)){
		lastName.style.backgroundColor = "red";
		sucess = false;
	} else {
		lastName.style.backgroundColor = "";
	}
	if(!checkCity(city.value)){
		city.style.backgroundColor = "red";
		sucess = false;
	} else {
		city.style.backgroundColor = "";
	}
	if(!checkZip(zipCode.value)){
		zipCode.style.backgroundColor = "red";
		sucess = false;
	} else {
		zipCode.style.backgroundColor = "";
	}
	if(!checkPhoneNumber(phoneNumber.value)){
		phoneNumber.style.backgroundColor = "red";
		sucess = false;
	} else {
		phoneNumber.style.backgroundColor = "";
	}
	
	return sucess;
	
}

function checkuserPassword(userPassword){
	let sucess = true;
	var reg1 = /\d+/
	if(!userPassword.match(reg1)){
		sucess = false;
	}

	if(!userPassword.match(/[a-z]+/)){
		sucess = false;
	}
	if(!userPassword.match(/[A-Z]+/)){
		sucess = false;
	}
	if(userPassword.match(/\W/)){
		sucess = false;
	}
	if(userPassword.match(/\s/)){
		sucess = false;
	}
	
	return sucess;
}

function checkUsername(username){
	let sucess = true;
	if(username.match(/\W/)){
		sucess = false;
	}
	if(username.match(/\s/)){
		sucess = false;
	}
	
	return sucess;
}

function checkCity(input){
	let sucess = true;
	if(input.match(/\W/)){
		sucess = false;
	}

	return sucess;
}

function checkName(input){
	let sucess = true;
	if(input.match(/\W/)){
		sucess = false;
	}
	if(input.match(/[0-9]/)){
		sucess = false;
	}
	if(input.match(/[0-9]/)){
		sucess = false;
	}

	return sucess;
}

function checkZip(input){
	let sucess = true;
	if(input.match(/\W/)){
		sucess = false;
	}
	if(input.match(/\s/)){
		sucess = false;
	}
	if(input.match(/[a-z]/)){
		sucess = false;
	}
	if(input.match(/[A-Z]/)){
		sucess = false;
	}
	if(!input.match(/[0-9]{4,}/)){
		sucess = false;
	}
	
	return sucess;
}

function checkPhoneNumber(input){
	let sucess = true;
	if(input.match(/\W/)){
		sucess = false;
	}
	if(input.match(/\s/)){
		sucess = false;
	}
	if(input.match(/[a-z]/)){
		sucess = false;
	}
	if(input.match(/[A-Z]/)){
		sucess = false;
	}
	if(!input.match(/([0-9]{8,})/)){
		sucess = false;
	}
	
	return sucess;
}

function checkEmail(input){
	let sucess = true;
	if(!input.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)){
		sucess = false;
	}
	return sucess;
}



