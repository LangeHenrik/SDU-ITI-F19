function ajax(){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                document.getElementById("index").innerHTML = xhttp.responseText;
        }
        };
        xhttp.open("GET", "latest.php", true);
        xhttp.send();
}
function loadajax(){
	let body = document.getElementsByTagName('body');
	if(body){
		if(document.getElementById("index")){
			ajax();
			setInterval(ajax,2000);
		}
	}else{
		setTimeout(loadajax,100);
	}
}
setTimeout(loadajax,100);
