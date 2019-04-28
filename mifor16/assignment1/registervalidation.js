function validateForm() {
    var username = document.getElementById("username").value;
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var zip = document.getElementById("zip").value;
    var city = document.getElementById("city").value;
    var mail = document.getElementById("mail").value;
    var phone = document.getElementById("phone").value;

    var boolUsername =  /^[0-9a-zA-Z]+$/.test(username);
    var boolFirstName =  /^[a-zA-Z]+$/.test(firstname);
    var boolLastName =  /^[a-zA-Z]+$/.test(lastname);
    var boolZip =  /^[0-9]+$/.test(zip);
    var boolCity =  /^[0-9a-zA-Z]+$/.test(city);
    var boolPhone =  /^[0-9]+$/.test(phone);

    if(boolUsername && boolFirstName && boolLastName && boolZip && boolCity && boolPhone) {
        return true;
    } else {
        alert("Invalid form input");
        return false;
    }

}