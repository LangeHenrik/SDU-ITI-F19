<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Upload</title>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="../css/magnific-popup.css">
	<!-- Salvattore -->
	<link rel="stylesheet" href="../css/salvattore.css">
	<!-- Theme Style -->
	<link rel="stylesheet" href="../css/style.css">
	<!-- Modernizr JS -->
	<script src="../js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="../js/respond.min.js"></script>
	<![endif]-->

</head>

<body>	
	<div id="fh5co-offcanvass">
		<a href="#" class="fh5co-offcanvass-close js-fh5co-offcanvass-close">Menu  </a>
		<h1 class="fh5co-logo"><a class="navbar-brand" href="../home/">Image Heap</a></h1>
		<ul>
			<li><a href="../home/">Home</a></li>
			<li class="active"><a href="../upload/">Upload</a></li>
			<li><a href="../users/">Users</a></li>
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
				<div class="col-md-8 col-md-offset-2">
					<h2>Upload</h2>
					<div class="fh5co-spacer fh5co-spacer-sm"></div>
					<form name="registerform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="form-group">
								<input type="file" name="file" placeholder="file" required>	
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="title" placeholder="Title">	
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<textarea name="description" id="description" cols="30" class="form-control" rows="5" placeholder="Description"></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" class="btn btn-primary" value="Upload">
								</div>
							</div>
						</div>
					</form>
				</div>
        	</div>
       </div>
	</div>

	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../js/jquery.waypoints.min.js"></script>
	<!-- Magnific Popup -->
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<!-- Salvattore -->
	<script src="../js/salvattore.min.js"></script>
	<!-- Main JS -->
	<script src="../js/main.js"></script>
	
</body>

</html>
