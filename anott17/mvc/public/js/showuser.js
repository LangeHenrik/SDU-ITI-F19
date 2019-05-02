function showUser(str) {
    if (str == "") {
        console.log(str);
        document.getElementById("searchResults").innerHTML = " ";
        return;
    } else {
        console.log(str);
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("searchResults").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/anott17/mvc/public/users/getUserAjax/" + str, true);
        xmlhttp.send();
    }
}
