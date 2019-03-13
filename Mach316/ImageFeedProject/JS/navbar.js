document.addEventListener("DOMContentLoaded", function(event) {

    element = document.getElementById("navbar");
    element.innerHTML += "" +
        "<a class=\"navbar-link\" href=\"Feed.php\">Home</a>" +
        "<a class=\"navbar-link\" href=\"PictureManagement.php\">My Images</a>"
});