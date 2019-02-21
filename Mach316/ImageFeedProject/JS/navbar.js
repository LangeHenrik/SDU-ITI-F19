document.addEventListener("DOMContentLoaded", function(event) {

    element = document.getElementById("navbar");
    element.innerHTML = "" +
        "<a class=\"navbar-link\" href=\"Feed.html\">Home</a>" +
        "<a class=\"navbar-link\" href=\"PictureManagement.html\">My Images</a>" +
        "<a class=\"navbar-link\" id=\"login-link\" href=\"LoginPage.html\">Login</a>"
});