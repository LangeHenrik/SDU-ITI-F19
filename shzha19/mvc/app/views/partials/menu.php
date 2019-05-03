<!---
<html>
<head>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="text-align: center">
-->
	<div style="height: 10%">
		<h2>Hello <?=$_SESSION['username']?></h2>
		<a href="/shzha19/mvc/public/index.php/logout" style="font-size: large; position: absolute;top:30px;right: 30px;">Log out</a>
	</div>
	<div class="navbar-collapse collapse"
			style="text-align: center; vertical-align: center; background: lightgrey; font-size: 20px;">
		<ul class="nav navbar-nav" style="display: inline-block;float: none;">
			<li class="active">
				<a href="/shzha19/mvc/public/index.php/pictures">Pictures</a>
			</li>
			<li class="">
				<a href="/shzha19/mvc/public/index.php/users">Users</a>
			</li>
			<li>
				<a href="/shzha19/mvc/public/index.php/mypictures">My Pictures</a>
			</li>
		</ul>
	</div>

	
		
	
	
	
		