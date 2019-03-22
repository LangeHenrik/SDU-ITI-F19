
function performAjax(){
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                var response=eval(this.responseText.split('<!DOCTYPE html>')[0]);
                if(response=='0'){
                    console.log("No More IMAGES!?");
                }else{
                    console.log(response);
                    injectImages(response);
                }
            }
        };
        xmlhttp.open("GET", "images.php?offset="+offset, true); 
        offset+=4;
        //true means it is asynchronous.
        xmlhttp.send();
}
let offset=20;

function injectImages(data){

    for(let i=0;i<data.length;i++){
        var columnid="column"+(i+1);
        var tmp =document.getElementById(columnid);
        tmp.innerHTML+=data[i]
    }
}

function monitorScroll(){
    if(amountscrolled()==100){
        performAjax();
    }
}


//Functions getDocHeight() and amountscrolled() 
//was found at:
// http://javascriptkit.com/javatutors/detect-user-scroll-amount.shtml
//THANKS
function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    )
}
function amountscrolled(){
    var winheight= window.innerHeight || (document.documentElement || document.body).clientHeight
    var docheight = getDocHeight()
    var scrollTop = window.pageYOffset || (document.documentElement || document.body.parentNode || document.body).scrollTop
    var trackLength = docheight - winheight
    var pctScrolled = Math.floor(scrollTop/trackLength * 100) // gets percentage scrolled (ie: 80 or NaN if tracklength == 0)
    //console.log(pctScrolled + '% scrolled')
    return pctScrolled;
}

function checkRegister() {
    alert("entered JS");
    var errorMessageContainer = document.getElementById("register-error-container");
    errorMessageContainer.innerHTML="";

    var username = document.getElementById("register-username").value.trim();
    var validUserName = /^[0-9a-zA-Z].{3,54}$/.test(username);

    var password = document.getElementById("register-password").value.trim();
    var validPassword = /^[0-9a-zA-Z].{7,254}$/.test(password);

    var secondPassword = document.getElementById("passwordSecond").value.trim();

    var firstname = document.getElementById("firstname").value.trim();
    var validFirstName = /^[a-zA-Z].{0,254}$/.test(firstname);

    var lastname = document.getElementById("lastname").value.trim();
    var validLastName = /^[a-zA-Z].{0,254}$/.test(lastname);

    var zip = document.getElementById("zip").value.trim();
    var validZipCode = /^[0-9]+$/.test(zip);

    var city = document.getElementById("city").value.trim();
    var validCity = /^[a-zA-Z].{0,254}$/.test(city);

    var phone = document.getElementById("phone").value.trim();
    var validPhoneNr = /^\+[0-9]{8,30}/.test(phone);

    var mail = document.getElementById("email").value.trim();
    var validMail = /\S+@\S+\.([a-z]|[A-Z]){1,5}$/.test(mail);

    var evalVar = true;



    if (!(validFirstName)) {
        console.log("fornavn forkert");
        errorMessageContainer.innerHTML += "Dit fornavn skal være bogstaver<br>";
        evalVar = false;
    }

    if (!(validLastName)) {
        console.log("efternavnforkert.");
        errorMessageContainer.innerHTML += "Dit efternavn må kun indeholde bogstaver<br>";
        evalVar = false;
    }

    if (!(validZipCode)) {
        console.log("Postnummer er forkert");
        errorMessageContainer.innerHTML += "Dit postnummer må kun være tal.<br>";
        evalVar = false;
    }

    if (!(validCity)) {
        console.log("bynavn forkert");
        errorMessageContainer.innerHTML += "Bynavne må kun have bogstaver i sig.<br>";
        evalVar = false;
    }

    if (!(validPhoneNr)) {
        console.log("forkert fonnummer");
        errorMessageContainer.innerHTML += "dit telefonnummer skal være mellem 8 og 30 tal og starte med '+' <br>";
        evalVar = false;
    }

    if (!(validMail)) {
        console.log("forkert email");
        errorMessageContainer.innerHTML += "Ugyldig email. prøv igen.<br>";
        evalVar = false;
    }

    if (!(validUserName)) {
        errorMessageContainer.innerHTML += "Brugernavn skal være mellem 4 og 55 tegn, og må kun indeholde bogstaver.<br>";
        console.log("Bad brugernavn");
        evalVar = false;
    }

    if (!(validPassword)) {
        errorMessageContainer.innerHTML += "Adgangskode skal være 8 tegn langt<br>";
        console.log("Bad adgangskode");
        evalVar = false;
    }

    if (password != secondPassword) {
        console.log("andet password er ikke lig det første");
        errorMessageContainer.innerHTML += "De indtastede adgangskoder er ikke ens.<br>";
        evalVar = false;
    }

    if (evalVar) {
        errorMessageContainer.innerHTML += "FYR DEN AF FYR! Log ind ovenfor, så kan du se nogle blærede billeder. <br>";
        return true;
    } else {
        return false;
    }
}
