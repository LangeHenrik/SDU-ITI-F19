<?php
	include_once 'header.php';
	include_once "includes/db_config.php";
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>Pictures</h2>
		<?php
			//check for user id
			if (isset($_SESSION['u_id'])) {
				
				
				
				
				?>

				<div id="pictures">
				<h2>20 Latest pictures</h2> ';
                <?php



                $sql = "SELECT * FROM pictures ORDER BY id DESC LIMIT 20;";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $pictures = $stmt->fetchAll();

                foreach ($pictures as $pic) {
                  ?>
                <li>
                    <figure id="<?php echo $pic['id']; ?>">
                        <b>
                            <figcaption><?php echo $pic["titlePicture"] ?>
                                <img src=<?php echo $pic["imageFullNamePicture"]  ?>>
                                <?php echo $pic["descPicture"] ?> <br>
                    </figure>
                </li>
                <?php

                

              }

				

			}
		?>

    
	</div>
</section>

<?php
	include_once 'footer.php';
?>
