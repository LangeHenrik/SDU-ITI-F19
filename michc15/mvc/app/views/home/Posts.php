
		<?php include '../app/views/partials/menu.php'; ?>
		<div class='container'>
		<div class="row">
		<?php foreach ($viewbag['Posts'] as $post){ ?>
			<div class="column mx-5">
			<div class="card" style="width: 22em;">
			<div class="card-body ">
		<h2 class="card-title"><?=$post['header']?></h2>
		<img  src="<?=$post['picture']?>" class="card-img-top" />
		<p class="card-text"><?=$post['description']?></p>
	</div>
	</div>
	</div>
<?php } ?>
		</div>
