<html>
	<head>
		<title>Users</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!-- <link rel="shortcut icon" type="image/png" href="/favicon.png"/> -->
			<link rel="stylesheet" type="text/css" href="/Asdoe17/mvc/public/css/style.css">
	</head>
	<body>

		<body>
			<nav>
			<ul>
				<?php include '../app/views/partials/menu.php'; ?>
			</u1>
			</nav>


			<div class="wrapper">
				<?php foreach ($viewbag['Users'] as $user){ ?>
					<article class="pic-text">

							<img src='<?=$user['picture']?>' alt='<?=$user['username']?>' class="img-artc-pic"/>
							<h2> <?=$user['username']?> </h2>

					</article>
				<?php } ?>
			</div>


	</body>
</html>
