<style><?include("css/bootstrap.css");?></style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>


<header>
<div class="navbar">
	<ul class="nav nav-pills">
			<li class="nav-item">
	    <a class="nav-link <?php if($CURRENT_PAGE == "Profile") {?>active<?php }?>" href="profile">Profile</a>
	  </li>
		<li class="nav-item">
	    <a class="nav-link <?php if($CURRENT_PAGE == "Users") {?>active<?php }?>" href="users">Users</a>
		</li>
		<li class="nav-item">
	    <a class="nav-link <?php if($CURRENT_PAGE == "Home") {?>active<?php }?>" href="home">Explore</a>
		</li>
	</ul>
</div>
</header>

</body>
</html>