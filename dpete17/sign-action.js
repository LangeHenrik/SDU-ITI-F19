function toggle() {
    let divRegister = document.getElementById('register');
    let divLogin = document.getElementById('login');

    divRegister.classList.toggle('hidden');
    divLogin.classList.toggle('hidden');
}

function validateLoginForm() {
    return validateUsername('logUsername') && validatePassword('logPassword');
}

function validateRegisterForm() {
    return validateUsername('regUsername') && validatePassword('regPassword') && validateRepeatPassword() && 
    validateFirstname() && validateLastname() && validateZip() && validateCity() && 
    validateEmail() && validatePhone();
}

function validateUsername(id) {
    let regex = /^(?=.*[A-Z])(\w){5,15}$/
    let element = document.getElementById(id);

    let valid = regex.test(element.value);
    toggleTitle(valid, element, 'Atleast one Capital letter and 5-15 characters.');

    return toggleValidation(regex.test(element.value), element);
}

function validatePassword(id) {
    let regex = /^(?=.*[A-Z])(?=.*[0-9])(\w){2,64}$/
    let element = document.getElementById(id);

    let valid = regex.test(element.value);
    toggleTitle(valid, element, 'Atleast one Capital letter, one numbers and 2-64 characters.');

    return toggleValidation(regex.test(element.value), element);
}

function validateRepeatPassword() {
    let password = document.getElementById('regPassword');
    let repeat = document.getElementById('regRepeat');

    let valid = password.value === repeat.value;
    toggleTitle(valid, repeat, 'Match Password.');

    return toggleValidation(valid, repeat);
}

function validateFirstname() {
    let regex = /^([A-Z][a-z]+)( [A-Z][a-z]*)?$/
    let element = document.getElementById('regFirstname');

    let valid = regex.test(element.value);
    toggleTitle(valid, element, 'Every word needs to start with Capital and no space at the end');

    return toggleValidation(regex.test(element.value), element);
}

function validateLastname() {
    let regex = /^([A-Z][a-z]+)( [A-Z][a-z]*)?$/
    let element = document.getElementById('regLastname');

    let valid = regex.test(element.value);
    toggleTitle(valid, element, 'Every word needs to start with Capital and no space at the end');

    return toggleValidation(regex.test(element.value), element);
}

function validateZip() {
    let regex = /^\d{4}$/
    let element = document.getElementById('regZip');

    let valid = regex.test(element.value);
    toggleTitle(valid, element, 'Exact four numbers.');

    return toggleValidation(regex.test(element.value), element);
}

function validateCity() {
    let regex = /^([A-Z][a-z]+)( [A-Z][a-z]*)?$/
    let element = document.getElementById('regCity');

    let valid = regex.test(element.value);
    toggleTitle(valid, element, 'Every word needs to start with Capital and no space at the end');

    return toggleValidation(regex.test(element.value), element);
}

function validateEmail() {
    let regex = /^(?=.*@).*$/
    let element = document.getElementById('regEmail');

    let valid = regex.test(element.value);
    toggleTitle(valid, element, 'Needs to contain the @ symbol.');

    return toggleValidation(regex.test(element.value), element);
}

function validatePhone() {
    let regex = /^\d{8}$/
    let element = document.getElementById('regPhone');

    let valid = regex.test(element.value);
    toggleTitle(valid, element, 'Exact eight numbers.');

    return toggleValidation(regex.test(element.value), element);
}

function toggleValidation(valid, element) {
    if(valid) {
        element.classList.add('valid');
        element.classList.remove('invalid');
    } else {
        element.classList.add('invalid');
        element.classList.remove('valid');
    }

    return valid;
}

function toggleTitle(valid, element, title) {
    if(!valid) {
        element.setAttribute('title', title);
    } else {
        element.removeAttribute('title');
    }
}