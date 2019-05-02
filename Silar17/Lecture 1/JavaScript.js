
    function checkFields() { 
        var name = document.getElementById("name").value;
		var regex = new RegExp("e");
		
		if(regex.test(name)){	
			alert("hej");
			return true;
		} else {
			
			alert("no");
			return false;	
		}
    } 
	function checkPassword(){
		var password = document.getElementById("password").value;
		var phone = document.getElementById("phone").value;
		var email = document.getElementById("email").value;
		var zip = document.getElementById("zip").value;
	}