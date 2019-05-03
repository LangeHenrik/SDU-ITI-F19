<html>
<head>
    <meta charset="utf-8">
    <title>Pictures</title>
    <link rel="stylesheet" href="/shzha19/mvc/public/css/pictures.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="text-align: center">
	<?php include '../app/views/partials/menu.php'; ?>
	
	<div class="row" style="margin-top: 1%; height: 100%; width: 100%">
		<div class="col-md-2 col-lg-2 col-xs-2 col-sm-2" style="background: lightgray; height: 100%;"><h1>Absolute greatest place for ads!</h1></div>
		<div class="col-md-8 col-lg-8 col-xs-8 col-sm-8" style="background: gray;">
			<?php foreach($viewbag['pictures'] as $pictures) { 	?>
			<div style="border-radius: 10px;  height: 40%; width: 100%;  ">
				<div class="col-md-4 col-lg-4 col-xs-4 col-sm-4" style="margin: 1%; border-radius: 10px; ">
					<?php echo "<img src='{$pictures['photo']}'";?>
					<img class="round_icon"  alt="">
					<h3><?php  echo $pictures['username'] ?></h3>
				</div>
				<div class="col-md-8 col-lg-8 col-xs-8 col-sm-8" style="margin: 1%; border-radius: 10px; width:60%; word-break:break-all;word-wrap:break-word">
					<?php echo "<img src='{$pictures['image']}' class='square_icon' ";?>
					<h3><?php  echo $pictures['title'] ?></h3>
					<h4><?php  echo $pictures['description'] ?></h4>
				</div>
			</div>
			<br/><HR width="100%" color=#FFFFFF SIZE=1>
			<?php
			}
			?>
		
		</div>
		<div class="col-md-2 col-lg-2 col-xs-2 col-sm-2" style="background: lightgray; height: 100%;"><h1>Absolute greatest place for ads!</h1></div>
	</div>
	
</body>
</html>



	
		
		
