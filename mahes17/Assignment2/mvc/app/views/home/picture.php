<?php
include_once 'menu.php';
?>


<section class="main-container">
	<div class="main-wrapper">
		<h2>Pictures</h2>
		<?php
			//check for user id
			if (isset($_SESSION['u_id'])) {




				?>

				<div id="pictures">
				
                <?php

if (isset($_SESSION['u_id'])) {
	include ("../../controllers/PicturesController.php");
}

              }




		?>


	</div>
</section>
