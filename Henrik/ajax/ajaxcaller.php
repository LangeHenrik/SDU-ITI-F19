<div id="ajaxcontainer"></div>


<script>

	function ajax() {
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("ajaxcontainer").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "randomgenerator.php?name=john", true);
        xmlhttp.send();
		
	}
	
	function js () {
		
		document.getElementById("ajaxcontainer").innerHTML = Math.random()*10000;
	}

   setInterval(ajax, 1000);


</script>