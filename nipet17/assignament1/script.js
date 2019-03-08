function checkName(){
    var name = document.getElementById("name").value;

    if (name !== (/^\w+\s+\w+$/g)){
        document.getElementById("lname").style.color = "red";
        return false;
    } else {
        return true;
        document.getElementById("lname").style.color = "green";
    }
}

function checkEmail() {
    var email = document.getElementById("email").value;

    if (email !== /^\S+@\S+\.([a-z]|[A-Z]){1,5}$/g) {
        document.getElementById("lemail").style.color = "red";
        return false;
    } else {
        document.getElementById("lemail").style.color = "green";
        return true;
    }
}

function checkPassword() {
    var password = document.getElementById("password").value;

    if(password !== /^[a-zA-Z0-9!@#$%^&*]{8,}$/g){
        document.getElementById("lpassword").style.color = "red";
        return false;
    } else {
        document.getElementById("lpassword").style.color = "green";
        return true;
    }
}

function saveUser() {
  
}
