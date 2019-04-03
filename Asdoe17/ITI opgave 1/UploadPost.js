function checkFields(){

	title = document.getElementById("post_title").value;
	description = document.getElementById("post_description").value;

	regex_Title = /^(\w|\s){1,50}$/g;
	regex_Description = /^([\x20-\x7D]|\s){1,500}$/g;

	correctInformation = true;

	if (regex_Title.test(title)){
		document.getElementById("post_title").style.borderColor="black";
	} else {
		document.getElementById("post_title").style.borderColor="red";
		correctInformation = false;
	}

	if (regex_Description.test(description)){
		document.getElementById("post_description").style.borderColor="black";
	} else {
		document.getElementById("post_description").style.borderColor="red";
		correctInformation = false;
	}

	return correctInformation;
}
