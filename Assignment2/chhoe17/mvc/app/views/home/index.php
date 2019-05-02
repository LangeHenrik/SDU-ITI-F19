<?php include 'menu.php'; ?>

<!-- Hello there, <?=/* $viewbag['name'] */hello ?> -->


<section class="main-container">
	<div class="main-wrapper">
		<h2>Home</h2>
		<?php
			//Check for users ID
			if (isset($_SESSION['u_id'])) {
				echo "You are logged in!";
			}
		?>
	</div>
</section>