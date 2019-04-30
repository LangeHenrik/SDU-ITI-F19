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

    var formdata = new FormData();
    formdata.append("userfile", file);
    formdata.append("header", header);
    formdata.append("subtext", subtext);

    var request = new XMLHttpRequest();
    request.upload.addEventListener("progress", uploadBar, false);
    request.addEventListener("load", uploadFinished, false);
    request.addEventListener("error", uploadError, false);
    request.open("POST", "upload.php", true);
    request.send(formdata);
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
