
<!DOCTYPE html>

<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/omhaw16/mvc/app/views/styling/style.css">
    <link rel="shortcut icon" type="image/png" href="/omhaw16/mvc/app/views/styling/favicon.png"/>

<title> PhotoPost - My Posts </title>

</head>

<body>

<h1> PhotoPost - My Posts </h1>
<p class = 'tagline'> Your photo-sharing website. </p>

 <?php $pathroot = realpath($_SERVER["DOCUMENT_ROOT"]);     

        include $pathroot . '/omhaw16/mvc/app/views/partials/navi.php';
        include $pathroot . '/omhaw16/mvc/app/views/partials/logout.php';
        include $pathroot . '/omhaw16/mvc/app/controllers/HomeController.php';?>
 <?php 

    if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

    $userID = $_SESSION['userID'];
    $hc = new HomeController();
    $hc->getMyPosts($userID);
    $hc->showMyPosts($userID); 

} else { 
	
		echo "<p class ='status'> You need to be logged in to view your posts. </p>";

	}
?>


</body>

</html>

