<?php include '../app/views/partials/menu.php';


  foreach($viewbag['pictures'] as $row) :
             ?>
					<div class = "image">
					<p><?=json_encode($row, JSON_PRETTY_PRINT);?></p>
          <img class="images" src='data:image/jpeg;base64, <?=$row['bl']?>' alt="//$row['name']">
					<br>
					<!--<a href = "picture_site.php?path=//$row['name']">';
					<img class="images" src="//$row['path']" alt="//$row['name']">';
        </a>--></div>;
			<?php
		endforeach;
