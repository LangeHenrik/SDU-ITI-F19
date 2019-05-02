<?php include '../app/views/partials/menu.php';


  foreach($viewbag['pictures'] as $row) :
             ?>
					<div class = "image">
					<p><?=json_encode($row, JSON_PRETTY_PRINT);?></p>
          <img class="images" src='data:image/jpeg;base64, <?=$row['image']?>' alt="">
					<br>
					</div>
			<?php
		endforeach;
