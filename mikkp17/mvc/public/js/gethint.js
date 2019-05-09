function getHint(str) {
    console.log("Test");
    if (str.length === 0) {
        document.getElementById("hint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("hint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "/mikkp17/mvc/public/users/ajax/" + str, true);
        xmlhttp.send();
        document.getElementById("hint").innerHTML = "Loading...";
    }
}