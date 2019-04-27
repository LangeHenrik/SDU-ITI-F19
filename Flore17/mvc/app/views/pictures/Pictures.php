<!DOCTYPE html>

<html>
	<head>
		
		<link rel="stylesheet" type="text/css" href="/Flore17/mvc/public/style.css">
		<script src="/Flore17/mvc/public/javascript.js"></script>

	</head>
	
	<body>

	<?php include '../app/views/partials/menu.php'; ?>

	<?php include '../app/views/partials/add.php'; ?>
		
		<div class="maincolumn">
			<!--form for uploading pictures with Header and comment-->

			<?php include '../app/views/partials/upload.php'; ?>
			
			<hr>
			
			<?php include '../app/views/partials/getPictures.php'; ?>
			
			<!--ajaxcontainer for loading more posts-->
			<div id="ajaxcontainer"></div>
			
		</div>
		
		<?php include '../app/views/partials/add.php'; ?>
		
	</body>
	
</html>

<?php include '../public/ajax.js';
?>
