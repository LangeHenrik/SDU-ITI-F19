function imageSearch(str) {
        const xmlHttpRequest = new XMLHttpRequest();
        xmlHttpRequest.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlHttpRequest.open("GET", "getImageSearch/" + str, true);
        xmlHttpRequest.send();
}
