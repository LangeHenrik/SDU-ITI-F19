<html>
	<head>
		<title>Upload Picture</title>
			 <meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!-- <link rel="shortcut icon" type="image/png" href="/favicon.png"/> -->
			<script src="/Asdoe17/mvc/public/js/UploadPost.js"></script>
			<link rel="stylesheet" type="text/css" href="/Asdoe17/mvc/public/css/style.css">
	</head>
	<body>
		<body>
			<nav>
			<ul>
				<?php include '../app/views/partials/menu.php'; ?>
			</u1>
			</nav>
		<div class='Simple-center'>

			<div class="Center-simple">
				<form action="/Asdoe17/mvc/public/Upload/post" method="POST" onsubmit="return checkFields()" enctype='multipart/form-data'>
					<label for="post_title">Title</label>
					<br>
					<?php if($viewbag['header_box_correct']){ ?>
						<input type='text' name='post_title' id='post_title' value='<?=$viewbag['header']?>' />
					<?php } else { ?>
						<input type="text" name="post_title" id="post_title" style="border:2px solid red;"/>
					<?php } ?>
					<br>
					<br>

					<label for="post_description">Description</label>
					<br>
					<?php if($viewbag['description_box_correct']){ ?>
						<textarea name="post_description" id="post_description"><?=$viewbag['description']?></textarea>
					<?php } else { ?>
						<textarea name="post_description" id="post_description" style="border:2px solid red;"></textarea>
					<?php } ?>
					<br>
					<br>

					<label for="image">Choose a picture</label>
					<br>
					<input type='file' name='image' />
					<br>
					<br>

					<input type="submit" name="submit" id="submit" value='Post'/>
				</form>
			</div>

		</div>
	</body>
</html>
