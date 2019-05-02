<html>    
	<head>        
		<title>HCHB's Exercise</title>
			<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --> 
			<!-- <link rel="shortcut icon" type="image/png" href="/favicon.png"/> --> 
			<link rel="stylesheet" type="text/css" href="/heboe17/mvc/public/css/GeneralLook.css">
	</head>
	<body> 
		<?php include '../app/views/partials/menu.php'; ?>
		<div class='main'>
			<?php include '../app/views/partials/GeneralContentLeft.php'; ?>
			<div class="content">
				<?php foreach ($viewbag['Users'] as $user){ ?>
					<div class="user_box">
						<div>
							<img src='<?=$user['picture']?>' alt='<?=$user['username']?>' class="profile_picture"/>
							<div class="user_name"> <?=$user['username']?> </div>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php include '../app/views/partials/GeneralContentRight.php'; ?>
		</div>
	</body>
</html>




