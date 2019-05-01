<?php include '../app/views/partials/header.php';?>

		
		<div class="maincolumn">
		
			<!-- Create Post -->
			<p> Make post: </p>
			<form action="/rafha13-2/mvc/public/content/create" method="POST" enctype="multipart/form-data" id="formid">
				<input class="post_title" type="text" placeholder="Title..." name="title" />
				</br> </br>
				<textarea rows="15" cols="100" placeholder="Description..."  name="description" form="formid"></textarea>
				</br> </br>
				<p> Max size: 2MB </p>
				<input type="file" name="pickImg" />
				</br> </br>
				
				<button type="submit"> Post Content </button>
			</form>
			</br>
			
			<hr class="line">
			
			<!-- Posts -->
			<?php 
				
				$content = $this->model('Content')->loadContent();

				for ($i = 20; $i >= 0; $i--) {
					if (!isset($content[$i]['image'])) {
						
					} else {
						?>
						<div class="pictures">
							<div class="user">
								<div class="userbox" style="background-color:white">
									<?php 
										//profile image	
										
										$userimage = $this->model('Content')->loadUsers($i);	

										if ($userimage[0]["user_Image"]  == null) {
											echo '
												<img class="profilepic" src="/rafha13-2/mvc/public/images/stock.jpg" >
											';
										} else {		
												
											
											echo '
													<img class="profilepic" src="data:' . $userimage[0]["user_img_type"] . '; base64, ' . base64_encode($userimage[0]["user_Image"]) . '"/>
											';
										}
										
										
										
										//user name
										echo '
													<h1 class="name" style="color:black">' . $content[$i]["post_user"] .
													'</h1>
										';
									?>
								</div>
							</div>
							<div class="post">
								<div class="post_picture_box">
									<?php
										// post image
										echo '
													<img class="post_picture" src="data:' . $content[$i]["post_img_type"] . '; base64, ' . base64_encode($content[$i]["image"]) . '"/>
										';
									?>
								</div>					
								<div class="post_text">
									<?php
										// post title
										echo '
											<h1>' . $content[$i]['title'] . '</h1>
										';
										// post description
										echo '
											<h2>' . $content[$i]['description'] . '<h2>
										';
									?>
								</div>
							</div>
						</div>
						
						<hr class="line">
						
						<?php
					}
				}
			?>
			
		</div>

	
		
<?php include '../app/views/partials/footer.php'; ?>