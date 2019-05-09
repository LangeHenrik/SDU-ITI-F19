
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> mschm16 </title>
<link rel="stylesheet" href="/mschm16/mvc/app/assets/css/style.css">
</head>
<body>

  <?php 
  $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     

  include $pathroot . '/mschm16/mvc/app/views/partials/navi.php';
  include $pathroot . '/mschm16/mvc/app/views/partials/logout.php';

  ?>

<div id="imgs">

  <?php 

    include $pathroot . '/mschm16/mvc/app/controllers/HomeController.php';

    echo "<h1>Home</h1>";
    
    $hc = new HomeController();
    $hc->getAllPosts();

    echo "<h1 class='allusers'>All users</h1>";

    $hc->showAllUsers();
    

    if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
      if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        $hc->showMyPosts($userID);
      }  
    } else {
      $userID = '0';
      $hc->showMyPosts($userID);
    }

  ?>

</div>

<!-- Ajax -->
<script> 

	function imgInfo(int) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("imgs").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "/mschm16/mvc/app/views/partials/getposts.php?q="+int, true);
    xhttp.send();
  }
</script>
</body>
</html>