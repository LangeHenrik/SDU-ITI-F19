
<!DOCTYPE html>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> PhotoPost </title>
  <link rel="stylesheet" href="/omhaw16/mvc/app/views/styling/style.css">
  <link rel="shortcut icon" type="image/png" href="/omhaw16/mvc/app/views/styling/favicon.png"/>
</head>

<body>

<h1> Welcome to PhotoPost! </h1>

<p class = 'tagline'> - Your photo-sharing website </p>

<div id="imgs">

<?php 

$pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     
    include $pathroot . '/omhaw16/mvc/app/controllers/HomeController.php';


// include dirname(__DIR__) . '/app/views/partials/navi.php';

// FOR TESTING PURPOSES: include 'index_old.php';

// include dirname(__DIR__) . '/app/views/partials/logout.php';

            echo "<h1> * </h1>";
            echo "<h2> All photos </h2>";
                       echo "<p class = 'intro'> The posts are sorted by time, with the newest being at the top. </p><br>";


    $hc = new HomeController();
    $hc->getAllPosts();

?>

</div>

<script> 
	function imgInfo(int) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("imgs").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getposts.php?q="+int, true);
  xhttp.send();
}
	</script>

<br>
<br>
</body>

</html>