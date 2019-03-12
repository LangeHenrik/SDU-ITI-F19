function checkUsername(username){
	//tjek om det er i databasen i forvejen
} 

function checkPassword(password){
	if ((password.value == "")||(password.value == null)){
	} else {
	var regex1 = new RegExp(/\S{8,}/g); // minumum 8 char
	var regex2 = new RegExp(/[a-z]/g); //least one lower case
	var regex3 = new RegExp(/[A-Z]/g); //least one upper case 
	var regex4 = new RegExp(/[0-9]/g); //least one number
	
	if(regex1.test(password.value)){
		if(regex2.test(password.value)){
			if(regex3.test(password.value)){
				if(regex4.test(password.value)){
					return true;
				}
				alert("The password must countain at least one number");
				setTimeout(function() { document.getElementById("password").focus(); }, 1);
				return false;
			} else {
				alert("The password must countain at least one upper case letter");
				setTimeout(function() { document.getElementById("password").focus(); }, 1);
				return false;
			}
		} else {
			alert("The password must countain at least one lower case letter");
			setTimeout(function() { document.getElementById("password").focus(); }, 1);
			return false;
		}
	} else {
		alert("The password must countain at least 8 carecters");
		setTimeout(function() { document.getElementById("password").focus(); }, 1);
		return false;
	}
	}
}

function checkRepeatPassword(repeatPassword){
	if ((repeatPassword.value == " ")||(repeatPassword.value == null)){
	} else {
	var password = document.getElementById("password").value;
	if ((password === repeatPassword.value)) {
		return true;
	} else {
		alert("The password must be repeated");
		setTimeout(function() {document.getElementById("repeatPassword").focus(); }, 1);
		return false
	}
}
}

function checkPhone(phone){
	//var phone = document.getElementById("phone").value;
	if ((phone.value == "")||(phone.value == null)){
	} else {
	var regex = new RegExp(/^\+/g);
	if (regex.test(phone)){
		if (phone.length >= 8 && phone.length <= 31){
			return true;
		} else {
			alert("The phone number must be between 8 and 30 digits long");
			setTimeout(function() { document.getElementById("phone").focus(); }, 1);
			return false;
		}
	} else {
		alert("The phone number must start with \"+\" ");
		setTimeout(function() { document.getElementById("phone").focus(); }, 1);
		return false;
	}
	}
}

function checkEmail(){
	var email = document.getElementById("email").value;
	if ((email == "")||(email == null)){
	}	else {
	var regex = new RegExp(/\S+\.{1}\S+@\S+\.{1}\S+\.{1}\S+/g);
	if (regex.test(email)){
		return true;
	} else {
		alert("Not a valid email");
		setTimeout(function() { document.getElementById("email").focus(); }, 1);
		return false;
	}
	}
}

function checkZip(){
	var zip = document.getElementById("zip").value;
	if ((zip == "")||(zip == null)){
	} else {
	if (zip.length == 4){
		return true;
	} else {
		alert("Zip mus be 4 digits exact");
		setTimeout(function() { document.getElementById("zip").focus(); }, 1);
		return false;
	}
	}
}