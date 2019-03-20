<script>
setInterval(ajax,200);
global function bob(){
fetch('latest.php')
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
    console.log(JSON.stringify(myJson));
  });
}
function ajax(){
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
       		// Typical action to be performed when the document is ready:
       		document.getElementById("main-content").innerHTML = xhttp.responseText;
    	}
	};
	xhttp.open("GET", "latest.php", true);
	xhttp.send();
}
</script>

