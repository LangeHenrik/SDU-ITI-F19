<?php
	$name = "Jackie";
	
	if($name === "Manny") : ?>
		Hi Mr. M
	<?php elseif ($name === "Jackie") : ?>
		Hi Mrs. J
	<?php elseif ($name === "Bo") : ?>
		Hi Mr. B
	<?php else : ?>
		Hi <?=$name?>
	<?php endif; ?>
	
	<br/><br/><br/>
	
	<?php 
	$names = array("Manny", "Jackie", "Bo", "Latifa");
	?>
	<br/><br/><hr/><br>
	<?php
for($i = 0; $i < sizeOf($names); $i++) {
	echo $names[$i] . ", ";
}
	?>
	<br><br><hr><br><br>
	<?php
foreach ( $names as $key => $value ) {
	echo $key . " " . $value . ", ";
}
	?>
	<br><br><hr><br><br>
	<?php
	foreach ( $names as $value ) {
		echo $key . " " . $value . ", ";
	}
	?>
	<br/><br/><hr/><br>
	<?php
	
$i = 0;
while($i < sizeof($names)) {
	echo $names[$i] . ", ";
	$i++;
}
	?>
	<br/><br/><hr/><br>
	<?php
	
	$i = 0;
	do {
		echo $names[$i] . ", ";
		$i++;
	} while ($i < sizeof($names));
	?>
	<br/><br/><HR><HR><HR><br>
	
	<?php
	for($i = 0; $i < sizeOf($names); $i++) :
		echo $names[$i] . ", ";
	endfor;
	?>
	
	<br><br><hr><br><br>
	
	<?php
foreach ( $names as $key => $value ) :
	echo $key . ", " . $value;
endforeach; ?>
	
	<br><br><hr><br><br>
	
	<?php
foreach ( $names as $value ) :
	echo $key . " " . $value;
endforeach;
	?>
	<br/><br/><hr/><br>
	
	<?php
$i = 0;
while($i < sizeof($names)) : 
echo $names[$i] . ", ";
$i++;
endwhile; ?>
	<br/><br/><hr/><br>
	<?php
	$i = 0;
	switch($name) {
		case "Manny":
		echo "Hello Mr. M";
		break;
		case "Jackie":
		echo "Hello Mrs. J";
		break;
		default:
		echo "Hello $name";
	}
	?>
	<br/><br/><hr/><br>
	<?php
	switch($name) :
		case "Manny":
		echo "Hello Mr. M";
		break;
		case "Jackie":
		echo "Hello Mrs. J";
		break;
		default:
		echo "Hello $name";
	endswitch;