<html>
<head>
    <meta charset="utf-8">
    <title>My Pictures</title>
    <link rel="stylesheet" href="/shzha19/mvc/public/css/pictures.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
 </head>
<body style="text-align: center">
	<?php include '../app/views/partials/menu.php'; ?>
	<div style="background: gray;  margin:auto">
		<!-- upload view -->
		<div style=" margin: auto;top:0; right: 0; left: 0; bottom: 0; width: 300px; height: 230px">
			<form action="/shzha19/mvc/public/picture/insertPost" method="post" enctype='multipart/form-data'>
				<table>
					<tr>
						<td style="height: 40px;"><span style="font-size:large; ">Title:</span></td>
						<td><input type="text" name="title" style=" border-radius:5px"/></td>
					</tr><br/>
					<tr>
						<td><span style="font-size:large; ">Description：</span></td>
						<td><textarea name="description" rows="3" cols="23" style="border-radius:5px;"></textarea></td>
					</tr>
				</table>
				<br/>
				<input type="file" name="image" id="image" value="upload"/>
				<br/>
				<input type="submit" name="submit" value="Submit"/>
			</form>
		</div>
		<HR width="100%" color=#FFFFFF SIZE=1>
		<!-- show my pictures -->
		<div style=" margin: auto;top:0; right: 0; left: 0; bottom: 0; width: 800px;">
			<?php foreach($viewbag['mypictures'] as $mypictures) { 	?>
			<div style="border-radius: 10px;  height: 40%; width: 100%;  ">
				<div class="col-md-4 col-lg-4 col-xs-4 col-sm-4" style="margin: 1%; border-radius: 10px; ">
					<?php echo "<img src='{$mypictures['photo']}' class='round_icon' >";?>
					<h3><?php  echo $mypictures['username'] ?></h3>
           		</div>
				<div class="col-md-8 col-lg-8 col-xs-8 col-sm-8" style="margin: 1%; border-radius: 10px;width:60%; word-break:break-all;word-wrap:break-word">
					<?php echo "<img src='{$mypictures['image']}' class='square_icon' ";?>
					<h3><?php  echo $mypictures['title'] ?></h3>
					<h4><?php  echo $mypictures['description'] ?></h4>
            	</div>
				<div style="width: 100%; text-align: center">
					<a href="/shzha19/mvc/public/picture/deletePost/<?php echo $mypictures['image_id'];?>"><input name="delete" value="Delete" type="submit" /></a>					
				</div>
			</div>
			<br/><br/><HR width="100%" color=#FFFFFF SIZE=1>
			<?php }?>
		</div>
	</div>
	
</body>
</html>
	
	
	

	




	
	

	

	


</body>
</html>