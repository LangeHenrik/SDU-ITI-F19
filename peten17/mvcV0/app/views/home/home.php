<?php  
        ?>


<h1>This is a view</h1>
<?php
//print_r($viewbag['pictures']);
foreach($viewbag['pictures'] as $pictures) {
	?>
	
	<div style="background-color: lightblue;">
		<p><?=$pictures['comment']?></p>
		<img src="<?=$pictures['image_path']?> />
	</div>
	
	<?php
}



?>



