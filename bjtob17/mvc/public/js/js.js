(function enableBurgerMenu() {
    document.addEventListener('DOMContentLoaded', () => {

        // Get all "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {

                    // Get the target from the "data-target" attribute
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);

                    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });
        }

    });
}());



function validate(inputElem) {
    const validators = {
        "username": {fn: (input) => input.value.length > 1, msg: "Username must contain at least two character"},
        "password": {fn: (input) => input.value.length >= 6, msg: "Password must contain at least six characters"},
        "password2": {fn: (input) => input.value === document.getElementById("password").value, msg: "Passwords must match"},
        "firstName": {fn: (input) => input.value.length > 0,msg: "First name must contain at least one character"},
        "lastName": {fn: (input) => input.value.length > 0, msg: "Last name must contain at least one character"},
        "zip": {fn: (input) => Number.isInteger(parseInt(input.value)), msg: "Zip must be a number"},
        "city": {fn: (input) => input.value.length > 1, msg: "City must contain at least one character"},
        "email": {fn: (input) => /.+@.+/.test(input.value), msg: "Invalid email"},
        "phone": {fn: (input) => input.value.length >= 8, msg: "Phone must contain at least eight digits"},

        "title": {fn: (input) => input.value.length > 0, msg: "Your image must have a title"},
        "caption": {fn: (input) => input.value.length > 0, msg: "Your image must have a caption"},
        "image": {
            fn: (input) =>
                input.files.length > 0
                && ["image/jpg", "image/jpeg", "image/png"].includes(input.files[0].type),
            msg: "You must choose an image"}
    };

    const type = inputElem.name;

    const isValid = validators[type].fn(inputElem);
    const errorDiv = document.getElementById(`${type}-error`);
    if (!isValid) {
        errorDiv.innerText = validators[type].msg;
        errorDiv.classList.remove("hidden");
        inputElem.classList.add("error-border");
    } else {
        errorDiv.classList.add("hidden");
        inputElem.classList.remove("error-border");
    }

    return isValid;
}

function validateAll(form) {
    const inputElements = form.getElementsByTagName("input");

    let allValid = true;

    for (let i = 0; i < inputElements.length; i++) {
        const isValid = validate(inputElements[i]);
        if (isValid === false) {
            allValid = false;
        }
    }

    return allValid;
}