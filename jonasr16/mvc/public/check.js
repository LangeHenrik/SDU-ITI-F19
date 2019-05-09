function checkInputs(){
    var username = document.getElementById("username").value;
    var fname = document.getElementById("firstname").value;
    var lname = document.getElementById("lastname").value;
    var zip = document.getElementById("zip").value;
    var city = document.getElementById("city").value;
    var number = document.getElementById("number").value;

    if(!/^[0-9a-zA-Z]+$/.test(username)){
        alert("Invalid username.");
        return false;
    }
    if(!/^[a-zA-Z]+$/.test(fname)){
        alert("Invalid first name.");
        return false;
    }
    if(!/^[a-zA-Z]+$/.test(lname)){
        alert("Invalid last name.");
        return false;
    }
    if(!/^[0-9]+$/.test(zip)){
        alert("Invalid zip.");
        return false;
    }
    if(!/^[a-zA-Z]+$/.test(city)){
        alert("Invalid city.");
        return false;
    }
    if(!/^[0-9]+$/.test(number)){
        alert("Invalid phone number.");
        return false;
    }
    return true;
}
