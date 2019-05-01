<?php
	//set det amount af post that has to be loaded
	
	$_SESSION['count'] = 20;
	$x = $_SESSION['count'];
				
	//prints out the 20 newest post with the newest on top and the oldest on det bottom
	foreach(array_reverse($viewbag['posts']) as $posts) :
		
		if (substr($posts['imagetmp'], 0, 5) == 'data:') {
			if ( $x > 0 )  {
?>
				<html>
					<div class="post">
						<div class="headerPost">
							<h1 style="font-size:2.5vw;"><b><?=$posts['header']?></b></h1>
						</div>
						<div class="postText">
							<div class="commPost">
									<p style="font-size:1.5vw;"><?=$posts['comm']?></p>
							</div>
						</div>
						<div class="postPicframe">
							<img class="postPic" src="<?=$posts['imagetmp']?>"/>
						</div>
					</div>
					<hr>
				</html>
		
<?php
			$x--;
			}
		} else {

			if ( $x > 0 )  {
?>
				<html>
					<div class="post">
						<div class="headerPost">
							<h1 style="font-size:2.5vw;"><b><?=$posts['header']?></b></h1>
						</div>
						<div class="postText">
							<div class="commPost">
									<p style="font-size:1.5vw;"><?=$posts['comm']?></p>
							</div>
						</div>
						<div class="postPicframe">
							<img class="postPic" src="data:<?=$posts['exttype']?>; base64, <?=base64_encode($posts['imagetmp']) ?>"/>
						</div>
					</div>
					<hr>
				</html>
		
<?php
			$x--;
			}
		}

	endforeach;

?>
