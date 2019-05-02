<?php

	foreach ($viewbag['pictures'] as $value){
			$picturepath = $value["image"];
			$picturetitle = $value["title"];
		echo "<div class='pictureframes'>";
		echo "<label>$picturetitle</label>"; 
		echo "<img src='$picturepath'>";
		echo "</div>";
		}
	

