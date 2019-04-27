/* === code for uploading pictures === */

function send() {
    var form = document.getElementById("fileform");
    var file = form.file.files[0];
    var filename = file.name; // filename without path
    var size = file.length; // size in bytes
    var type = file.type; // MIME-type
    var header = form.header.value;
    var subtext = form.subtext.value;

    if(size > 10485760) {
     	alert("File too big");
     	return 1;
    }

    var reader = new FileReader();
    reader.readAsBinaryString(file);

    reader.onload = function() {
        base64 = btoa(reader.result);

        var json_string = JSON.stringify({
            "image": base64,
            "title": header,
            "description": subtext,
        });

        var formdata = new FormData();
        formdata.append("json", json_string);
        console.log(json_string);

        var request = new XMLHttpRequest();
        request.upload.addEventListener("progress", uploadBar, false);
        request.addEventListener("load", uploadFinished, false);
        request.addEventListener("error", uploadError, false);
        request.open("POST", "/jahen19/mvc/public/api/pictures/user/", true);
        request.send(formdata);
    };
    reader.onerror = function() {
        console.log('Problem reading file');
    };

}

function uploadBar(event) {
    if (event.lengthComputable) {
        var percentComplete = Math.round(event.loaded / event.total * 100);
        document.getElementById("fileform").submit.value = percentComplete + "%";
    }
}

function uploadFinished(event) {
    var response = event.target.responseText;
    var obj = JSON.parse(response);
    if (obj != undefined && obj.image_id != undefined && typeof obj.image_id == 'number') {
        // all good, nothing went wrong

        // reload the page to show the new image
        location.reload();
        return true;
    } else {
        alert("Sorry, something went wrong: " + response);
        document.getElementById("fileform").submit.value = "Upload";

        // do not reload page (to retain form contents)
        return false;
    }

}

function clearUploadForm() {
    document.getElementById("fileform").reset();
    document.getElementById("fileform").submit.value = "Upload";
}

function uploadError(event) {
    console.log("Error: " + event);
    document.getElementById("fileform").submit.value = "Upload";
    alert("Sorry, something went wrong.");
}

/* === code for deleting pictures === */
function deletePicture(obj) {
    var image_id = obj.value;

    // submit query to server
    var formdata = new FormData();
    var request = new XMLHttpRequest();
    request.addEventListener("load", deleteFinished, false);
    request.addEventListener("error", deleteError, false);
    request.open("POST", "/jahen19/mvc/public/api/delete/picture/" + image_id, true);
    request.send(formdata);
}

function deleteFinished(event) {
    var response = event.target.responseText;
    if(response.search("OK") == -1) {
        // oops, something went wrong
        alert("Sorry, something went wrong: " + response);
    } else {
        // all good, nothing went wrong
        alert("Successfully deleted.");

        // reload page to update content
        location.reload();
    }
}

function deleteError(event) {
    console.log("Error: " + event);
    alert("Sorry, something went wrong.");
}

/* === QUOTES API === */

function fetchQuote() {
    $.ajax({
        type: "GET",
        url: "http://quotes.rest/qod.json",
        dataType: "json",
        cache: true,
        success: function (data) {
            $("#quote-text").html(data.contents.quotes[0].quote);
            $("#quote-author").html(data.contents.quotes[0].author);
        }
    });
}

/* === WEATHER API === */

var apiKey = "hoArfRosT1215";
function fetchWeather() {
    var location = $("#location").html();

    locationUrl = "http://apidev.accuweather.com/locations/v1/search?q=" + location + "&apikey=" + apiKey;
    $.ajax({
        type: "GET",
        url: locationUrl,
        dataType: "jsonp",
        cache: true,                    // Use cache for better reponse times
        jsonpCallback: "awxCallback",   // Prevent unique callback name for better reponse times
        success: function (data) { getWeather(selectLocationKey(data)); }
    });
}

function selectLocationKey(data) {
    console.log(data.length, " Locations found");
    if (data.length == 0) {
        $("#weather-conditions").html("No weather data available");
        return;
    }
    locationKey = data[0].Key;
    localName = data[0].LocalizedName;
    countryId = data[0].Country.ID;
    $("#location").html(localName + " (" + countryId + ")");
    return locationKey;
}

function getWeather(locationKey) {
    if (locationKey == null) {
        return;
    }

    currentConditionsUrl = "http://apidev.accuweather.com/currentconditions/v1/" + locationKey + ".json?language=en&apikey=" + apiKey;
    $.ajax({
        type: "GET",
        url: currentConditionsUrl,
        dataType: "jsonp",
        cache: true,                    // Use cache for better reponse times
        jsonpCallback: "awxCallback",   // Prevent unique callback name for better reponse times
        success: function (data) {
            var temp;
            var description;
            if(data && data.length > 0) {
                temp = data[0].Temperature.Metric.Value + "°" + data[0].Temperature.Metric.Unit;
                description = data[0].WeatherText;
            } else {
                temp = "N/A";
            }
            $("#weather-conditions").html(description + " @ " + temp);
        }
    });
}

/* === these functions are run when the DOM is ready === */
$(function() {
    fetchQuote();
    fetchWeather();
});
