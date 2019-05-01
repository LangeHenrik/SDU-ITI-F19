<title>Silar17-assignment2</title>
<!-- may not be neseary <meta charset="UTF-8"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="/silar17/mvc/public/javaScript/javaScript.js"></script>
<link href="/silar17/mvc/public/css/site.css" rel="stylesheet" type="text/css"/>
<body>

<!-- Navgiation bar (sit on top) -->
<div class="-top">
  <div class="-nav">
    <a href="/silar17/mvc/public/home/" class="-bar-item -button">
	<b>Larsen</b> Solutions</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="-right">
	<?php if (isset($_SESSION['username'])){ ?> 
		<?php if(!isset($_SESSION['preload'])){ ?>
	  <a href="/silar17/mvc/public/upload/preloadImage/" class="-bar-item -buttion">Preload pictures</a>
		<?php } ?>
		<a href="/silar17/mvc/public/picture/" class="-bar-item -button">Pictures</a>
		<a href="/silar17/mvc/public/upload/" class="-bar-item -button">Upload</a>
		<a href="/silar17/mvc/public/user/" class="-bar-item -button">Users</a>
		<a href="/silar17/mvc/public/contact/" class="-bar-item -button">Contact</a>
		<a href="/silar17/mvc/public/login/" class="-bar-item -button"> Login</a>
		<a href="/silar17/mvc/public/logout/" class="-bar-item -button"> logout</a>
	<?php } else { ?>	
	  <a href="/silar17/mvc/public/login/" class="-bar-item -button"> Login</a>
	 <?php } ?>
    </div>
  </div>
</div>
