<?php include '../app/views/partials/header.php';?>

			<div class="maincolumn">
				
			
				<?php 

				$users = $this->model('Users')->getUsers();

				for ($i = 0; $i < 6; $i++) : ?>
					<div class="userbox">
						<?php if ($users[$i]["user_Image"] == null) : ?> 
							<img class="profilepic" src="/rafha13-2/mvc/public/images/stock.jpg" >
						<?php  else : 
							echo '
							<img class="profilepic" src="data:' . $users[$i]["user_img_type"] . '; base64, ' . base64_encode($users[$i]["user_Image"]) . '"/>
							';
						endif;
						?>
					
						<h1 class="name">
						<?=$users[$i]["username"]?>
					</div>
				<?php endfor; ?>
				
				
			</div>

<?php include '../app/views/partials/footer.php'; ?>