<?php foreach ($viewbag['Posts'] as $post){ ?>
	<div class="post_box">
		<h1><?=$post['header']?></h1>
		<img alt="Failure to load image is your fault!" src="<?=$post['picture']?>" />
		<p class="post_text"><?=$post['description']?></p>
	</div>
<?php } ?>