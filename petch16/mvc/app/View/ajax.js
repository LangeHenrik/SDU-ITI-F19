$("#showUsers").click(function(){
    $("#usersDiv").empty()
    $.ajax({
            url: "ajax.php",
            type: "GET",
            dataType: "json",
                success: function (data) {
                    $("#usersDiv").append(`
                    <table class="greyGridTable">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Created at</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Zip</th>
                        <th>City</th>
                        <th>Email</th>
                        <th>Phonenumber</th>
                    </tr>
                    </thead>
                    <tbody id="usersTbody">
                
                    </tbody>
                </table>
                    `)
                    $.each(data, function(index, item) {
                        if(item.id == undefined){}else{
                    $("#usersTbody").append(`
                    <tr id="${item.id}">
                        <td>${item.username}</td>
                        <td>${item.created_at}</td>
                        <td>${item.firstname}</td>
                        <td>${item.lastname}</td>
                        <td>${item.zip}</td>
                        <td>${item.city}</td>
                        <td>${item.email}</td>
                        <td>${item.phonenumber}</td>
                    </tr>`);}
                    });
                        }
                , error: function (data) {
                        }
                    });
});

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