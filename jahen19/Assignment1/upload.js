function send() {
    var form = document.getElementById("fileform")
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
    document.getElementById("wrapper-form").style.display = "none";
    document.getElementById("loading").style.display = "block";
    document.getElementById("finished").style.display = "none";
}

function uploadFinished(event) {
    var response = event.target.responseText;
    if(response.search("OK") == -1) {
        // oops, something went wrong
        document.getElementById("finished").innerHTML = "Sorry, something went wrong. Please try again.<br>" + response;
    } else {
        // all good, nothing went wrong
        var text = "Link to your file: " + response;
	    document.getElementById("finished").innerHTML += text;
    }

    document.getElementById("wrapper-form").style.display = "none";
    document.getElementById("loading").style.display = "none";
    document.getElementById("finished").style.display = "block";
}

function uploadError(event) {
    console.log("Error: " + event);
    alert("Sorry, something went wrong.");
}
