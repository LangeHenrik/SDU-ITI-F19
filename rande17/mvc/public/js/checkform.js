function checkForm() {
    if (checkPass() && checkusername() && checkfname() && checklname() && checkcity() && checkmail() && checkphone() && checkzip()) {
        return true;
    } else {
        let err = document.getElementById("err");
        err.innerHTML = "Please recheck the form";
        return false;
    }

    //return (checkPass() && checkusername());
}

function checkPass() {
    let input = document.getElementById("password").value;
    console.log(input);
    let regex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
    return regex.test(input);
}

function checkusername() {
    let input = document.getElementById("username").value;
    console.log(input);
    let regex = new RegExp("^([A-z]{3,})");
    return regex.test(input);
}

function checkfname() {
    let input = document.getElementById("fname").value;
    console.log(input);
    let regex = new RegExp("^([A-z]{3,})");
    return regex.test(input);
}

function checklname() {
    let input = document.getElementById("lname").value;
    console.log(input);
    let regex = new RegExp("^([A-z]{3,})");
    return regex.test(input);
}

function checkcity() {
    let input = document.getElementById("city").value;
    console.log(input);
    let regex = new RegExp("^([A-z]{3,})");
    return regex.test(input);
}

function checkmail() {
    let input = document.getElementById("mail").value;
    console.log(input);
    let regex = new RegExp("^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\\.[a-zA-Z0-9-]+)*$");
    return regex.test(input);
}

function checkphone() {
    let input = document.getElementById("phone").value;
    console.log(input);
    let regex = new RegExp("^([0-9]{8,12})");
    return regex.test(input);
}

function checkzip() {
    let input = document.getElementById("zip").value;
    console.log(input);
    let regex = new RegExp("^([0-9]{3,6})");
    return regex.test(input);
}