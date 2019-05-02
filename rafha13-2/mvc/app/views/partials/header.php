<!DOCTYPE html>
<html>
	<head>
	
		<title>Assignment 2</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src='/rafha13-2/mvc/public/js/FormValidation.js'></script>
		<link rel="stylesheet" type="text/css" href='/rafha13-2/mvc/public/css/PageStyle.css'>
	
	</head>
	<!--Comment-->
	<body>
		
		<div class="nav">
			<?php if($_SESSION['page'] == 'content') { ?> 
				<a class="active" href="/rafha13-2/mvc/public/content"> <u> Content </u> </a> 
				<a class="links" href="/rafha13-2/mvc/public/user"> <u> Users </u> </a> 
				<a class="links" href="/rafha13-2/mvc/public/mypage"> <u> My Page </u> </a>  
			<?php } elseif ($_SESSION['page'] == 'user') { ?>
				<a class="links" href="/rafha13-2/mvc/public/content"> <u> Content </u> </a> 
				<a class="active" href="/rafha13-2/mvc/public/user"> <u> Users </u> </a> 
				<a class="links" href="/rafha13-2/mvc/public/mypage"> <u> My Page </u> </a>  
			<?php } elseif ($_SESSION['page'] == 'mypage') { ?>
				<a class="links" href="/rafha13-2/mvc/public/content"> <u> Content </u> </a> 
				<a class="links" href="/rafha13-2/mvc/public/user"> <u> Users </u> </a> 
				<a class="active" href="/rafha13-2/mvc/public/mypage"> <u> My Page </u> </a>  
			<?php } ?>
			
			
			
			<div class="account"> 
				<a class="links" href="/rafha13-2/mvc/public/home/logout"> <u> Logout </u> </a> 
			</div>
						
			<div class="weather">
				<img src="/rafha13-2/mvc/public/images/weather.png" style="height:35px"/>
			</div>
			
		</div>
		
		
	<div class="back">
		<div class="add" style="left:15px">
			<h2 style="color:white">Absolute greatest place for ads!</h2>
		</div>
			