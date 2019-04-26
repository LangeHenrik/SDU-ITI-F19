
    function checkFields() { 
		checkName();
		checkPassword();
		checkPhone();
		checkEmail();
		checkZip();
    } 
	
	function checkName(nameField){
		var name = document.getElementById("name");
		if (((name.value == "")||(name.value == null))&&(nameField.id == name.id)){
		} else {
		var regex = new RegExp(/\w+\s+\w+/g);
		if(regex.test(name.value)){	
			return true;
		} else {
			alert("The name must contain both first name and surname.");
			return false;	
			
		}
		}
	}
	
	function checkPassword(passwordField){
		var password = document.getElementById("password");
		if (((password.value == "")||(password.value == null))&&(passwordField.id == password.id)){
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
					return false;
				} else {
					alert("The password must countain at least one upper case letter");
					return false;
				}
			} else {
				alert("The password must countain at least one lower case letter");
				return false;
			}
		} else {
			alert("The password must countain at least 8 carecters");
			return false;
		}
		}
	}
	
	function checkPhone(){
		var phone = document.getElementById("phone").value;
		if ((phone == "")||(phone == null)){
		} else {
		var regex = new RegExp(/^\+/g);
		if (regex.test(phone)){
			if (phone.length >= 8 && phone.length <= 31){
				return true;
			} else {
				alert("The phone number must be between 8 and 30 digits long");
				return false;
			}
		} else {
			alert("The phone number must start with \"+\" ");
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
			return false;
		}
		}
	}
	
	function checkZip(){
		var zip = document.getElementById("zip").value;
		if ((zip == "")||(zip == null)){
		} else {
		var regex = new ReqExp(/\d{4}/g);
		if (regex.test(zip)){
			return true;
		} else {
			alert("Zip mus be 4 digits exact");
			return false;
		}
		}
	}