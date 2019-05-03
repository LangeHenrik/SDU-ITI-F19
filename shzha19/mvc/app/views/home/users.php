<html>
<head>
    <meta charset="utf-8">
    <title>User</title>
    <link rel="stylesheet" href="/shzha19/mvc/public/css/users.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="text-align: center">
	<?php include '../app/views/partials/menu.php'; ?>
	
	<div class="row" style="margin-top: 1%; height: 100%; width: 100%">
		<div class="col-md-2 col-lg-2 col-xs-2 col-sm-2" style="background: lightgray; height: 100%;"><h1>Absolute greatest place for ads!</h1></div>
		<div class="col-md-8 col-lg-8 col-xs-8 col-sm-8" style="background: gray;height: 100%;">
			<?php   $count = 0 ; foreach($viewbag['users'] as $usersin) { 	?>
			<div style="margin: 1%; border-radius: 10px; background-color: lightgrey; height: 28%; width: 20%; float:left">
				<?php  echo "<img src='{$usersin['photo']}'";?>
				<img  class="round_icon"  alt="">
				<h3><?php  echo $usersin['username'] ?></h3>
			</div>
			<?php	//每行显示四个头像
				$count++;
				if($count%4==0)
					echo "<br/>";
			}	?>		
		</div>
		<div class="col-md-2 col-lg-2 col-xs-2 col-sm-2" style="background: lightgray; height: 100%;"><h1>Absolute greatest place for ads!</h1></div>

	</div>
	<?php include '../app/views/partials/foot.php'; ?>
</body>
</html>





	