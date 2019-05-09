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

let calls = 0;

window.onscroll = function(ev) {

    var scrollHeight, totalHeight;
    scrollHeight = document.body.scrollHeight;
    totalHeight = window.scrollY + window.innerHeight;
	let height = document.getElementById("content").clientHeight;
	document.getElementById("Left").style.height = height+"px";
	document.getElementById("Right").style.height = height+"px";

    if(totalHeight >= scrollHeight){
		calls+=1;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

				ele = document.createElement('div');
				ele.innerHTML = this.response;

                document.getElementById("content").appendChild(ele);

            }
        };
        xmlhttp.open("GET", "/michc15/mvc/public/Posts/ajaxPostLoader/"+calls, true);
        xmlhttp.send();
    }


};

function checkUserFields(){

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

function checkImageFields(){

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