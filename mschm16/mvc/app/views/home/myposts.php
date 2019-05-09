
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/mschm16/mvc/app/assets/css/style.css">
<title>My Posts</title>
</head>
<body>

 <?php 
 $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     

    include $pathroot . '/mschm16/mvc/app/views/partials/navi.php';
    include $pathroot . '/mschm16/mvc/app/views/partials/logout.php';
    include $pathroot . '/mschm16/mvc/app/controllers/HomeController.php';
?>
    <h1>My Posts</h1>
<?php
    if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
        $userID = $_SESSION['userID'];
        $hc = new HomeController();
        $hc->getMyPosts($userID);
        $hc->showMyPosts($userID); 
    } else { 
        echo "<p class ='status'> You need to be logged in to view your posts. </p>";
        header("Location: /mschm16/mvc/app/views/home/login.php");
        exit;
	}
?>

</body>
</html>