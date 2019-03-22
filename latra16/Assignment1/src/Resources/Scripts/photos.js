Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}

function closePhotoModal(){
    document.body.classList.remove("stop-scrolling");
    document.getElementById("overlay").parentNode.removeChild(document.getElementById("overlay"));
}

function getDetails(id){
    var overlay = document.createElement('div');
    overlay.id = 'overlay';
    overlay.innerHTML = "<div class=\"lds-roller\"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
    overlay.classList.add("loading");
    document.body.appendChild(overlay);
    document.body.classList.add("stop-scrolling");

    fetch('/photos/details?photo_id=' + id)
    .then(function(response) {
        return response.json();
    })
    .then(function(json) {
        var innerHtml = '<div class="overlay_inner">'+
        ''+
        '    <div class="overlay_inner_left">'+
        '        <button onclick="closePhotoModal()">Close</button>'+
        '        <span class="label">Title</span>'+
        '        <span class="title">'+
                    json["title"] +
        '        </span>'+
        '        <span class="label">Caption</span>'+
        '        <span class="caption">'+
                     json["caption"]+
        '        </span>'+
        '        <span class="label">Photographer</span>'+
        '        <span class="photographer">'+
                     json["uploader"]["firstname"] + ' ' + json["uploader"]["lastname"] +
        '        </span>'+
        '        <span class="label">Uploaded</span>'+
        '        <span class="date">'+
                     json["uploadDate"] +
        '        </span>'+       
        '    </div>'+
        '    <div class="overlay_inner_right">'+
        '        <img src="assets/img/' + json["photoName"] + '">'+
        '    </div>'+
        '</div>';
        overlay.innerHTML = '';
        overlay.innerHTML = innerHtml;
        overlay.classList.remove("loading");
    });
}