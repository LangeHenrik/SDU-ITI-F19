function assetSearch(str) {
        const xmlHttpRequest = new XMLHttpRequest();
        xmlHttpRequest.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlHttpRequest.open("GET", "getAssetSearch/" + str, true);
        xmlHttpRequest.send();
}