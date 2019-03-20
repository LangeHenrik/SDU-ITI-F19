function checkForm(){
	let input = document.getElementById("password").value.length;
	let err = document.getElementById();
	if(input >= 8){
		return true;
	}else{
		err.innerHTML.text("Password is to short");
		return false;
	}
}
