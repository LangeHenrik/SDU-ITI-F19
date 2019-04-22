
var userName = document.getElementById("user_name");
var htmlUser = document.getElementById("query_style");

var currentIndex = 0;


function updateFeed() {
    
    var xhttp;
    xhttp = new XMLHttpRequest();
    feed=document.getElementById("full");
    xhttp.onreadystatechange = function() {
        console.log(this.responseText);
        
        if (this.readyState == 4) {        
            if (this.status == 200) {
                var json = JSON.parse(this.responseText);
                renderHTML(json);
            }

            if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
            
        }
    }
    var query = null;
    if(htmlUser!=null) {
        query = htmlUser.innerHTML;
    }
    
    if(query == null ) {
        xhttp.open("GET", "/ajax_calls/get_image_data?start_index="+currentIndex+"&amount=20", true);
    } else {
        xhttp.open("GET", "/ajax_calls/get_image_data?start_index="+currentIndex+"&amount=20&user_images="+query, true);
    }
    currentIndex+=20;
    xhttp.send();
    /* Exit the function: */
    return;
}

function deletePost(id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    
    console.log("http://localhost/ajax_calls/delete_image?image_id="+id);
    xhttp.open("POST", "http://localhost/ajax_calls/delete_image?image_id="+id, true);
    xhttp.send();
    
    
    
    location.reload(true);
}

function viewComments(id) {
    
    window.location.replace("image_comments?image_id="+id);
}

function renderHTML(data) {
    var html = "";
    
    for(i = 0; i < data.length; i++) {
        html+="<div class = \"image_post\">";
        html+="<div class = \"info\">";
        html+="<h1>" + data[i].title + "</h1>";
        html+="<h2>User:" + data[i].user + "</h1>";
        html+="<p>" + data[i].description + "</p>";
        html+="</div>";
        
        html+="<img src=\"" + data[i].imagePath + "\">";
        html+="<caption>" + data[i].imageDate + "</caption>";
        html+="<button = 'button' onclick='viewComments(" + data[i].id +")'>Comment</button>";
        
        if (document.readyState !== 'complete') {
        }
        
        userName = document.getElementById("user_name");
        
        if(userName.innerHTML == data[i].user) {
            html+="<button = 'button' onclick='deletePost(" +data[i].id+ ")'>Delete</button>";
        }
        
        
        html+="</div>";
    }
    
    feed.insertAdjacentHTML("beforeend", html);
}

window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        updateFeed();
    }
};
