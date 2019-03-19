
function checkForm(){

	let err = "";
	let regname = new RegExp("[a-z|A-Z]{1,}\\s[a-z|A-Z]{1,}");
	let inputname = document.getElementById("name").value;
	
	if(regname.test(inputname)){
		console.log("Name is Good");
	}else{
		err += "<li>name is bad</li>"
	}

	if(err !== ""){
		document.appendChild
	}
	console.log(err);
}
