(() => init())();

function init() {
    setWeather();
}

function setWeather() {
    const location = "odense,dk"; // Copenhagen
    getWeatherData(location).then(weatherData => {
        document.getElementById("city").innerText = weatherData.city;
        document.getElementById("icon").src = weatherData.icon;
        document.getElementById("description").innerText = weatherData.description;
        document.getElementById("value").innerText = weatherData.temp;
        document.getElementById("unit").innerText = weatherData.tempUnit;
        document.getElementById("up").innerText = weatherData.sunrise;
        document.getElementById("down").innerText = weatherData.sunset;
    });
}

function getWeatherData(location) {
    const apiUrl = `http://api.openweathermap.org/data/2.5/weather?q=${location}&appid=ef681ac49df64e02a154f4ee4bf3591c&units=metric`;
    const options = {
    };
    return window.fetch(apiUrl, options).then(res => res.json())
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