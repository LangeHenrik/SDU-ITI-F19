function validateForm() {
    let valid = false;

    removeErrorMessages()

    try {
        let validEmail = validateEmail();
        let validPhoneNumber = validatePhonenumber();
        let validName = validateName();
        let validCity = validateCity();
        let validPassword = validatePassword();
        let samePassword = validatePasswordComparison();
        let validZip = validateZip();

        valid = validEmail
            && validPhoneNumber
            && validName
            && validCity
            && validPassword
            && samePassword
            && validZip;

    } catch (e) {
        console.log(e)
    }
    return valid
}

function validateName() {
    let firstNameNode = document.getElementById('input-block-firstname');
    let lastNameNode = document.getElementById('input-block-lastname');
    let firstNameInputNode = document.getElementById('input-firstname');
    let firstName = firstNameInputNode.value;
    let lastName = document.getElementById('input-lastname').value;
    let valid = (((firstName + " " + lastName).split(" ")).length == 2) && firstName.length > 0 && lastName.length > 0
    if (!valid) {
        createMessageElementAndAppend("Choose 1 firstname", firstNameNode)
        createMessageElementAndAppend("Choose 1 lastname", lastNameNode)
    }
    return valid;
}

function validateCity() {
    let cityRegex = /^[A-z]/g

    let cityNode = document.getElementById('input-block-city');
    let cityInputNode = document.getElementById('input-city')
    let city = cityInputNode.value;
    let valid = cityRegex.test(city) && city.length > 0
    if(!valid) {
        let message = "You must enter a city name (letters only)"
        createMessageElementAndAppend(message, cityNode)
    }
    return valid;
}

function validatePhonenumber() {
    let phonenumberRegex = /^[0-9]/g;

    let phoneNumberNode = document.getElementById('input-block-phonenumber');
    let phoneNumberInputNode = document.getElementById('input-phonenumber')
    let phonenumber = phoneNumberInputNode.value;
    let valid = phonenumberRegex.test(phonenumber) && phonenumber.length == 8;
    if (!valid) {
        let message = "Phonenumber must consist of 8 digits"
        createMessageElementAndAppend(message, phoneNumberNode);
    }
    return valid;
}

function validateEmail() {

    let emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/g;

    let emailNode = document.getElementById('input-block-email');
    let emailInputNode = document.getElementById('input-email');
    let email = emailInputNode.value;
    let validEmail = emailRegex.test(email);
    if (!validEmail) {
        let message = "Email is invalid"
        createMessageElementAndAppend(message, emailNode);
    }
    return validEmail;
}


function validatePassword() {

    let passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;

    let passwordNode = document.getElementById('input-block-password');
    let passwordInputNode = document.getElementById('input-password');
    let password = passwordInputNode.value;
    let valid = passwordRegex.test(password);
    if (!valid) {
        let message = "Password must be 8-20 characters long, have at least: 1 uppercase letter, 1 lowercase letter, 1 digit and 1 symbol"
        createMessageElementAndAppend(message, passwordNode);
    }

    return valid;

}

function validatePasswordComparison() {
    let passwordNode = document.getElementById('input-block-repeated-password');
    let valid = comparePasswords();
    if (!valid) {
        let message = "Passwords doesnt match"
        createMessageElementAndAppend(message, passwordNode)
    }

    return valid;
}

function validateZip() {
    let zipRegex = /^[0-9]/g
    let zipNode = document.getElementById('input-block-zip');
    let zipInputNode = document.getElementById('zip-input')
    let zip = zipInputNode.value;
    let valid = zipRegex.test(zip) && zip.length == 4
    if(!valid) {
        let message = "Zipcode needs to be exactly 4 digits long"
        createMessageElementAndAppend(message, zipNode)
    }
    return valid;
}

function comparePasswords() {
    let passwordInputNode = document.getElementById('input-password');
    let psw1 = passwordInputNode.value;
    let passwordRepeatedInputNode = document.getElementById('input-repeated-password');
    let psw2 = passwordRepeatedInputNode.value;
    return psw1 == psw2;

}

function createMessageElementAndAppend(message, node) {
    let messageSpanElement = document.createElement('span');
    messageSpanElement.classList.add("error-message")
    let messageElement = document.createTextNode(message);
    messageSpanElement.appendChild(messageElement);
    node.appendChild(messageSpanElement);

}

function removeErrorMessages() {
    const errorMessages = document.getElementsByClassName('error-message');
    let i = errorMessages.length;
    while(i--){
       errorMessages[i].parentNode.removeChild(errorMessages[i]);
    }
}




