<?php
  require 'header.php';

 ?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<title>
	Assignment One
	</title>
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	<link rel="stylesheet" href="./style.css"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!--meta tag that makes this website scalable on different devices -->

  <!--<script type="text/javascript" src='ajax.js'> </script> -->

</head>

<body>

<?php

foreach($viewbag['Pictures'] as $picture) :
?>

<div style="background-color: lightblue;">
    <h2><?=$picture['title']?></h2>
    <p><?=$picture['description']?></p>
    <img src="<?=$picture['image']?>" alt="<?=$picture['title']?>" />
</div>

<?php
endforeach;
?>

</body>
</html>
