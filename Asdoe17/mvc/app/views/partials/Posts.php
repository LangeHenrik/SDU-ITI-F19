<?php foreach ($viewbag['Posts'] as $post){ ?>
	<article class="pic-text">
		<h2><?=$post['header']?></h2>
		<p><?=$post['description']?></p>
		</article>
		<img alt="Failure to load image is your fault!" class="img-artc-pic" src="<?=$post['picture']?>" />


<?php } ?>
