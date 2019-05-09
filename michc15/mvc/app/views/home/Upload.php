
		<?php include '../app/views/partials/menu.php'; ?>
			<div class="container">
			<div class= "card card-body bg-light mt-5">
				<form action="/michc15/mvc/public/Upload/post" method="POST" onsubmit="return checkImageFields()" enctype='multipart/form-data'>
					<div class="form-row">
					<div class="col">
					<?php if($viewbag['header_box_correct']){ ?>
						<input type='text' placeholder="Title" class="form-control" name='post_title' id='post_title' value='<?=$viewbag['header']?>' />
					<?php } else { ?>
						<input type="text" name="post_title" placeholder="Title" class="form-control" id="post_title" style="border:2px solid red;"/>
					<?php } ?>
					<br>
					</div>
					</div>
					<div class="form-row">
					<div class="col">
					<?php if($viewbag['description_box_correct']){ ?>
						<textarea name="post_description" placeholder="Description" class="form-control" id="post_description"><?=$viewbag['description']?></textarea>
					<?php } else { ?>
						<textarea name="post_description" class="form-control" placeholder="Description" id="post_description" style="border:2px solid red;"></textarea>
					<?php } ?>
					</div>
					</div>
					<br>
					<label class="btn btn-outline-primary" for="file-selector">
    				<input id="file-selector" name='image' type="file" class="d-none">
  					 Choose Picture
					</label>
					<br>
					<br>
					<input type="submit" class="btn btn-primary btn-lg" name="submit" id="submit" value='Post'/>
				</form>
		</div>

