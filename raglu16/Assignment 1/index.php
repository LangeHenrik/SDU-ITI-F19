<?php
require_once "db_conn.php";

session_start();

if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
	header("location: login.php");
}
?>

<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Image Heap</title>
	
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
		<a href="#" class="fh5co-offcanvass-close js-fh5co-offcanvass-close">Menu </a>
		<h1 class="fh5co-logo"><a class="navbar-brand" href="index.php">Image Heap</a></h1>
		<ul>
			<li class="active"><a href="index.php">Home</a></li>
			<li><a href="upload.php">Upload</a></li>
			<li><a href="users.php">Users</a></li>
			<li><a href="register.php">Register</a></li>
		</ul>
		<?php if((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
			echo '<a href="logout.php" class="btn btn-primary">Logout</a>';
		} ?>
	</div>
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="#" class="fh5co-menu-btn js-fh5co-menu-btn">Menu</a>
					<a class="navbar-brand" href="index.php">Image Heap</a>		
				</div>
			</div>
		</div>
	</header>
	
	<div id="fh5co-main">
		<div class="container">

			<div class="row">

        <div id="fh5co-board" data-columns>
			<?php
				$stmt = $conn->prepare("SELECT * FROM images"); //sql select query
				$stmt->execute();
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			?>
        	<div class="item">
        		<div class="animate-box">
	        		<a href="<?php echo htmlspecialchars($row["source"]); ?>" 
					class="image-popup fh5co-board-img" 
					title="<?php if($row["title"] == ""){echo "[no title]";} else{echo $row["title"];}?>"><img src="<?php echo $row["source"]; ?>" 
					alt=<?php echo htmlspecialchars($row["source"]);?>></a>
        		</div>
				<div class="fh5co-item-title"><?php if($row["title"] == ""){ echo "[no title]";} else{ echo htmlspecialchars($row["title"]);}?></div>
        		<div class="fh5co-desc"><?php if($row["description"]== ""){ echo "[no description]";} else{echo htmlspecialchars($row["description"]);}?></div>
        	</div>
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
