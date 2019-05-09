
		<?php include '../app/views/partials/menu.php'; ?>
			<div class= "container">
				<div class="row">
				<?php foreach ($viewbag['Users'] as $user){ ?>
					<div class="column">
					<div class="card" style="width: 15em;">
							<img src='<?=$user['picture']?>' alt='<?=$user['username']?>' class="card-img-top"/>
							<div class="card-body">			
						<div class="user_name"> <?=$user['username']?> </div>
						</div>
						</div>
						</div>	
				<?php } ?>
			</div>
		</div>
	</body>
</html>




