
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

    echo "<h1>Users</h1>";
    $hc = new HomeController();
    $hc->showAllUsers();
  ?>

</div>

</body>
</html>