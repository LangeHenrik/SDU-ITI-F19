function loginSubmit(){

	if (checkPassword(document.getElementById("password")) 
		&& checkRepeatPassword(document.getElementById("repeatPassword"))
		&& checkFirstname(document.getElementById("firstname")) 
		&& checkLastname(document.getElementById("lastname")) 
		&& checkEmail(document.getElementById("email")) 
		&& checkZip(document.getElementById("zip")) 
		&& checkPhone(document.getElementById("phone"))) {
		return true;
	} else {
		return false;
	}
}

function checkUsername(username){ 
		if ((username.value == "")||(username.value == null)) {
			document.getElementById("usernameSpec").innerHTML = "";
			document.getElementById("username").style.background = "white";
			return false;
		} else {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200){
				if (this.responseText == "1"){
					document.getElementById("username").style.background = "url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/check.svg)";
					document.getElementById("username").style.backgroundRepeat = "no-repeat";
					document.getElementById("username").style.backgroundPosition = "right top";
					document.getElementById("usernameSpec").innerHTML = "";
					return true;
				} else {
					document.getElementById("username").style.background = "white";
					document.getElementById("usernameSpec").innerHTML = "Not avaiable";
					return false;
				}
			}
		};
		xmlhttp.open("GET", "fun-check-username.php?user=" + username.value, true);
		xmlhttp.send();
		}
} 

function checkPassword(password){
	return true;
	if ("password" == password.id){
		if ((password.value == "")||(password.value == null)) {
			document.getElementById("passwordSpec").innerHTML = "";
		} else {
	let regex1 = new RegExp(/\S{8,}/g); // minumum 8 char
	let regex2 = new RegExp(/[a-z]/g); //least one lower case
	let regex3 = new RegExp(/[A-Z]/g); //least one upper case 
	let regex4 = new RegExp(/[0-9]/g); //least one number
	
	if(regex1.test(password.value)){
		if(regex2.test(password.value)){
			if(regex3.test(password.value)){
				if(regex4.test(password.value)){
					document.getElementById("passwordSpec").innerHTML = "";
					return true;
				} 
				document.getElementById("passwordSpec").innerHTML = "The password must countain at least one number";
				return false; 
			} else {
				document.getElementById("passwordSpec").innerHTML = "The password must countain at least one upper case letter";
				return false;
			}
		} else {
			document.getElementById("passwordSpec").innerHTML = "The password must countain at least one lower case letter";
			return false;
		}
	} else {
		document.getElementById("passwordSpec").innerHTML = "The password must countain at least 8 carecters";
		return false;
	}
	}
	}
}

function checkRepeatPassword(repeatPassword){
	if ("repeatPassword" == repeatPassword.id){
		if ((repeatPassword.value == "")||(repeatPassword.value == null)){
			document.getElementById("repeatSpec").innerHTML = "";
		} else {
	let password = document.getElementById("password").value;
	if ((password === repeatPassword.value)) {
		document.getElementById("repeatSpec").innerHTML = "";
		return true;
	} else {
		document.getElementById("repeatSpec").innerHTML = "Passwords must be the same";
		return false
	}
	}
	}
}

function checkFirstname(firstname) {
	if ("firstname" == firstname.id){
		if ((firstname.value == "" )||(firstname.value == null)){
			document.getElementById("firstname").style.background = "white";
			document.getElementById("firstnameSpec").innerHTML = "";
		} else {
	let regex = new RegExp(/^[a-zA-Z]+$/g);
	if (regex.test(firstname.value)){
		document.getElementById("firstname").style.background = "url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/check.svg)";
		document.getElementById("firstname").style.backgroundRepeat = "no-repeat";
		document.getElementById("firstname").style.backgroundPosition = "right top";
		document.getElementById("firstnameSpec").innerHTML = "";
		return true;
	} else {
		document.getElementById("firstname").style.background = "white";
		document.getElementById("firstnameSpec").innerHTML = "Only letters";
		return false;
		
		
	}
	}
	}
}

function checkLastname(lastname) {
	if ("lastname" == lastname.id){
		if ((lastname.value == "" )||(lastname.value == null)){
			document.getElementById("lastname").style.background = "white";
			document.getElementById("lastnameSpec").innerHTML = "";
		} else {
	let regex = new RegExp(/^[a-zA-Z]+$/g);
	if (regex.test(lastname.value)){
		document.getElementById("lastname").style.background = "url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/check.svg)";
		document.getElementById("lastname").style.backgroundRepeat = "no-repeat";
		document.getElementById("lastname").style.backgroundPosition = "right top";
		document.getElementById("lastnameSpec").innerHTML = "";
		return true;
	} else {
		document.getElementById("lastname").style.background = "white";
		document.getElementById("lastnameSpec").innerHTML = "Only letters";
		return false;	
	}
	}
	}
}

function checkEmail(email){
	if ("email" == email.id){
		if ((email.value == "")||(email.value == null)){
			document.getElementById("email").style.background = "white";
			document.getElementById("emailSpec").innerHTML = "";
		} else {
	let regex = new RegExp(/\S+@\S+\.{1}\S+/g);
	if (regex.test(email.value)){
		document.getElementById("email").style.background = "url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/check.svg)";
		document.getElementById("email").style.backgroundRepeat = "no-repeat";
		document.getElementById("email").style.backgroundPosition = "right top";
		document.getElementById("emailSpec").innerHTML = "";
		return true;
	} else {
		document.getElementById("email").style.background = "white";
		document.getElementById("emailSpec").innerHTML = "Not valid email";
		return false;
	}
	}
	}
}

function checkZip(zip){
	
	
	if ("zip" == zip.id){
		if ((zip.value == "")||(zip.value == null)){
			document.getElementById("zipSpec").innerHTML = "";
		} else {
	if (zip.value.length == 4){
		document.getElementById("zipSpec").innerHTML = "";
		return true;
	} else {
		document.getElementById("zipSpec").innerHTML = "Zip must be 4 digits";
		return false;
	}
	}
	}
}

function checkPhone(phone){
	if ("phone" == phone.id){
		if ((phone.value == "")||(phone.value == null)){
			document.getElementById("phone").style.background = "white";
			document.getElementById("phoneSpec").innerHTML = "";
		} else {
	let regex = new RegExp(/^[+]/g);
	if (regex.test(phone.value)){
		if (phone.value.length > 8 && phone.value.length <= 31){
			document.getElementById("phone").style.background = "url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/check.svg)";
			document.getElementById("phone").style.backgroundRepeat = "no-repeat";
			document.getElementById("phone").style.backgroundPosition = "right top";
			document.getElementById("phoneSpec").innerHTML = "";
			return true;
		} else {
			document.getElementById("phone").style.background = "white";
			document.getElementById("phoneSpec").innerHTML = "Must be longer than 8 number";
			return false;
		}
	} else {
		document.getElementById("phone").style.background = "white";
		document.getElementById("phoneSpec").innerHTML = "form \" +45123456578 \"";
		return false;
	}
	}
	}
}
