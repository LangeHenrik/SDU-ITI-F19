<?php 
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
?>

<html>    
	<head>        
		<title>HCHB's Exercise</title>
			<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --> 
			<!-- <script src="myscripts.js"></script> --> 
			<!-- <link rel="shortcut icon" type="image/png" href="/favicon.png"/> --> 
			<!-- <body background="bgimage.jpg">  -->
			<!-- <body bgcolor="#E6E6FA">  -->
			<link rel="stylesheet" type="text/css" href="GeneralLook.css">
	</head>
	<body> 
		<?php
			include 'NavigationBar.php';
		?>
		<div class='main'>
			<?php
				include 'GeneralContentLeft.php';
			?>
			
			<div class="content"> Welcome
			</div>
			
			<?php
				include 'GeneralContentRight.php';
			?>
		</div>
	</body>
</html>