
let calls = 0;

window.onscroll = function(ev) {
   
    var scrollHeight, totalHeight;
    scrollHeight = document.body.scrollHeight;
    totalHeight = window.scrollY + window.innerHeight;
	let height = document.getElementById("content").clientHeight;
	document.getElementById("Left").style.height = height+"px";
	document.getElementById("Right").style.height = height+"px";

    if(totalHeight >= scrollHeight){
		calls+=1;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				
				ele = document.createElement('div');
				ele.innerHTML = this.response;
				
                document.getElementById("content").appendChild(ele);

            }
        };
        xmlhttp.open("GET", "AjaxPostLoader.php?q="+calls, true);
        xmlhttp.send();
    }


};