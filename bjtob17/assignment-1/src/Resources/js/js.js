(() => init())();

function init() {
    setWeather();
}

function setWeather() {
    const location = "odense,dk"; // Copenhagen
    getWeatherData(location).then(weatherData => {
        document.getElementById("city").innerText = weatherData.city;
        document.getElementById("icon").src = weatherData.icon;
        //document.getElementById("description").innerText = weatherData.description;
        document.getElementById("value").innerText = weatherData.temp;
        document.getElementById("unit").innerText = weatherData.tempUnit;
        document.getElementById("up").innerText = weatherData.sunrise;
        document.getElementById("down").innerText = weatherData.sunset;
    });
}

function getWeatherData(location) {
    const apiUrl = `http://api.openweathermap.org/data/2.5/weather?q=${location}&appid=ef681ac49df64e02a154f4ee4bf3591c&units=metric`;
    return window.fetch(apiUrl).then(res => res.json())
    .then(response => {
        const sunrise = new Date(response["sys"]["sunrise"]*1000);
        const sunset = new Date(response["sys"]["sunset"]*1000);
        return {
            "city": response["name"],
            "country": response["sys"]["country"],
            "temp": (response["main"]["temp"]),
            "description": response["weather"][0]["description"],
            "windSpeed": (response["wind"]["speed"]),
            "sunrise": `${sunrise.getHours().toString().padStart(2, '0')}:${sunrise.getMinutes().toString().padStart(2, '0')}`,
            "sunset": `${sunset.getHours().toString().padStart(2, '0')}:${sunset.getMinutes().toString().padStart(2, '0')}`,
            "tempUnit": "°C",
            "windUnit": "m/s",
            "icon": `http://openweathermap.org/img/w/${response["weather"][0]["icon"]}.png`
        };
    }).catch(err => console.log(err));
}

function deletePhoto(photoId) {
    const data = new FormData();
    data.append("id", photoId);

    const options = {
        method: "post",
        body: data
    };
    window.fetch("/photos/delete", options)
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                window.location.reload();
            }
        })
        .catch(err => {
            console.log(err);
    });
}

function validate(inputElem) {
    const validators = {
        "username": {fn: (input) => input.value.length > 1, msg: "Username must contain at least two character"},
        "password": {fn: (input) => input.value.length >= 6, msg: "Password must contain at least six characters"},
        "password2": {fn: (input) => input.value === document.getElementById("password").value, msg: "Passwords must match"},
        "firstName": {fn: (input) => input.value.length > 0,msg: "First name must contain at least one character"},
        "lastName": {fn: (input) => input.value.length > 0, msg: "Last name must contain at least one character"},
        "zip": {fn: (input) => Number.isInteger(parseInt(input)), msg: "Zip must be a number"},
        "city": {fn: (input) => input.value.length > 1, msg: "City must contain at least one character"},
        "email": {fn: (input) => /.+@.+/.test(input.value), msg: "Invalid email"},
        "phone": {fn: (input) => input.value.length > 8, msg: "Phone must contain at least eight digits"},

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
