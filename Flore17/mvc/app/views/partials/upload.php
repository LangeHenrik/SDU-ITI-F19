			<div class="upload">
				<form action="/flore17/mvc/public/pictures/makePost/" method="post" enctype="multipart/form-data">
					<h1 class="header3"> Make a post: </h1>
					<input type="text" name="postHeader" id="Header" placeholder="Header" >
					<br>
					<textarea class="subject" type="text" name="subject" id="Subject" placeholder="What's on your mind?"></textarea>
					<br>
					<input class="signUP" type="file" name="imageToUpload" id="imageToUpload">
					<br>
					<button type="submit" class="signUP">Make Post</button>
				</form>	
			</div>