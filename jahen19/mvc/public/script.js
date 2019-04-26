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
    if(response.search("OK") == -1) {
        // oops, something went wrong
        alert("Sorry, something went wrong: " + response);
        document.getElementById("fileform").submit.value = "Upload";
    } else {
        // all good, nothing went wrong
        var link = response.split('OK: ', 2)[1];
//        var text = '<a href="' + link + '">Click here to view your file</a>';

        // reload page to update content
        location.reload();

        document.getElementById("fileform").submit.value = "Finished";

        // clear upload form after 3 seconds
        setTimeout(clearUploadForm, 3000);
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

function deletePicture(obj) {
    var filename = obj.value;

    // submit query to server
    var formdata = new FormData();
    formdata.append("filename", filename);

    var request = new XMLHttpRequest();
    request.addEventListener("load", deleteFinished, false);
    request.addEventListener("error", deleteError, false);
    request.open("POST", "delete.php", true);
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
