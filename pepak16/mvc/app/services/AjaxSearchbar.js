function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        //document.getElementById("defaultpage").innerHTML = "<?php include_once $_SERVER[\"DOCUMENT_ROOT\"].\'/pepak16/mvc/app/controllers/HomeController.php\'; $controllerObject = new HomeController(); $allPosts = $controllerObject->showAllPosts(); foreach ($allPosts as $post) { echo \'<div class=\"gallery\"> <img src=\"\'.$post[4].\'\"> <div class=\"header\"><h2>\'.$post[2].\'</h2></div> <div class=\"desc\">\'.$post[3].\'</div> </div>'; } ?>";
        //document.getElementById("txtHint").innerHTML = "<div id=\"content\">Please refresh page to view all content again.</div>";
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
