function checkFields() {
    
    console.log("It works!");
    var name = document.getElementById("name").value;
    var password = document.getElementById("password").value;
    var phoneNumber = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var zip = document.getElementById("zip").value;

    if (password.length < 20) { 
    alert("Go fuck yourself you trash ass piece of shit and write a secure password. You deserve death.")
        return false;
    }
    
}