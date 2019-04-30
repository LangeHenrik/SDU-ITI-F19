/**
 * Method to validate a complete form.
 * @param {Complete form containing inputs} form 
 */
function validateForm(form){
    const elementRefs = form.getElementsByTagName("input");
    let formValid = true;
    for(let i = 0; i < elementRefs.length; i++){
        const elemValid = validateInput(elementRefs[i]);
        if(elemValid === false) formValid = false; 
    }
    return formValid;
}

/**
 * Method for client side validation of inputs.
 * @param {Reference to input} elementRef 
 */
function validateInput(elementRef){

    const rules = {
        "username": {
            regexp: /[a-zA-Z][a-zA-Z0-9.\-_]{5,31}/, err: "Username not valid due to one of the following rules: The first character must be a letter. The username can only contain alphanumeric characters, periods, hyphens, and underscores. The username is 6-32 characters long."
        },
        "password": {
            regexp: /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}/, err: "Your password must at least contain 8 characters, at least one uppercase letter, one lowercase letter, one number, and one special character."
        },
        "confirm_password": {
            fn: (elem) => elem.value == document.getElementsByName("password")[0].value, err: "The passwords do not match."
        },
        "firstname": {
            fn: (elem) => elem.value.length >= 1, err: "Your first name must contain at least 1 character."
        },
        "lastname": {
            fn: (elem) => elem.value.length >= 1, err: "Your last name must contain at least 1 character."
        },
        "city": {
            fn: (elem) => elem.value.length >= 1, err: "Your city must contain at least 1 character."
        },
        "zip": {
            regexp: /[0-9]/, err: "Your zip code can only contain numbers."
        },
        "email": {
            regexp: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/, err: "Your email seems to be invalid."
        },
        "phone": {
            regexp: /[0-9]/, err: "Your phone number can only contain numbers."
        },
        "file": {
            fn: (elem) => elem.files.length > 0, err: "You have to choose an image."
        },
        "title": {
            fn: (elem) => elem.value.length >= 1, err: "You must write a title."
        },
        "caption": {
            fn: (elem) => elem.value.length >= 1, err: "Your must write a description."
        },

    }

    let elemValid = false;

    if(rules[elementRef.name].hasOwnProperty('regexp')){
        const regexp = rules[elementRef.name].regexp;
        elemValid = regexp.test(elementRef.value);
    }

    if(rules[elementRef.name].hasOwnProperty('fn')){
        elemValid = rules[elementRef.name].fn(elementRef);
    }   

    if(!elemValid){
        elementRef.classList.add("error");
        elementRef.classList.remove("valid");
        if(elementRef.parentNode.getElementsByTagName("error").length == 0){
            var error = document.createElement('error');
            error.className = "error";
            error.innerHTML = "<p>" + rules[elementRef.name].err +  "</p>";
            elementRef.parentNode.insertBefore(error, elementRef.nextSibiling);
        }
    } else{
        elementRef.classList.remove("error");
        elementRef.classList.add("valid");
        if(elementRef.parentNode.getElementsByTagName("error").length == 1){    
            elementRef.parentNode.removeChild(elementRef.parentNode.getElementsByTagName("error")[0]);
        }
    }

    return elemValid;
}