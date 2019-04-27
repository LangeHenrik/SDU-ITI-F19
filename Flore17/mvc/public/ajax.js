<script>
//Ajax caller: calling for 20 more post, when the user reaches the bottom, every time the user does so.

window.onscroll = function(ev) {
	
	var body = document.body;
	var html = document.documentElement;

	var heightDocument = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );

    if ((window.innerHeight + window.scrollY) >= heightDocument - 1) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
                document.getElementById("ajaxcontainer").innerHTML = this.responseText;
                heightDocument = heightDocument;
            }
        };
        xmlhttp.open("GET", "/flore17/mvc/app/views/partials/ajaxloop.php", true);
        xmlhttp.send();
    };
};

</script>
