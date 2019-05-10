<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Users</title>

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Salvattore -->
	<link rel="stylesheet" href="css/salvattore.css">
	<!-- Theme Style -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>
		
	<div id="fh5co-offcanvass">
		<a href="#" class="fh5co-offcanvass-close js-fh5co-offcanvass-close">Menu  </a>
		<h1 class="fh5co-logo"><a class="navbar-brand" href="../home/">Image Heap</a></h1>
		<ul>
			<li><a href="../home/">Home</a></li>
			<li><a href="../upload/">Upload</a></li>
			<li class="active"><a href="../users/">Users</a></li>
			<li><a href="../register/">Register</a></li>
		</ul>
		<?php if((isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true)){
			echo '<a href="logout.php" class="btn btn-primary">Logout</a>';
		} ?>
	</div>
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="#" class="fh5co-menu-btn js-fh5co-menu-btn">Menu </a>
					<a class="navbar-brand" href="../home/">Image Heap</a>		
				</div>
			</div>
		</div>
	</header>
	<!-- END .header -->
	
	<div id="fh5co-main">
		<div class="container">
			<div class="row">
					<h2>Users</h2>
					<div class="fh5co-spacer fh5co-spacer-sm"></div>
					<div class="row">
						<table style="width:100%;">
						<tr>
							<th>Username</th>
							<th>Name</th>
							<th>Zip</th>
							<th>City</th>
							<th>E-mail</th>
							<th>Phone number</th>
						</tr>
						<?php
							require "db_conn.php";
							$stmt=$conn->prepare("SELECT username, firstname, lastname, zip, city, email, phonenumber FROM users");
							$stmt->execute();
							while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						?>
						<tr>
							<td><?php echo htmlspecialchars($row["username"]); ?></td>
							<td><?php echo htmlspecialchars($row["firstname"] . " " . $row["lastname"]); ?></td>
							<td><?php echo htmlspecialchars($row["zip"]); ?></td>
							<td><?php echo htmlspecialchars($row["city"]); ?></td>
							<td><?php echo htmlspecialchars($row["email"]); ?></td>
							<td><?php echo htmlspecialchars($row["phonenumber"]); ?></td>
						</tr>
						<?php
							}
						?>
					</div>
					
        		
        	</div>
       </div>
	</div> 

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<!-- Salvattore -->
	<script src="js/salvattore.min.js"></script>
	<!-- Main JS -->
	<script src="js/main.js"></script>
	
</body>

</html>
