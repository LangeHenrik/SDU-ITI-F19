function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
                document.getElementById("defaultpage").innerHTML = "";
            }
        }
        xmlhttp.open("GET", "../../services/getSearchResults.php?search="+str, true);
        xmlhttp.send();
    }
}
